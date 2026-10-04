# Kata de arquitectura de Symfony

Una kata para practicar la parte de arquitectura del temario de la
[certificación de Symfony](https://certification.symfony.com/): componentes,
bundles, rutas y contenedor de servicios. Daniel Funes la escribió en 2017
para la certificación de Symfony 3, y en 2026 se migró a **Symfony 7.4 LTS,
PHP 8.4 y PHPUnit 12**, con los ejercicios adaptados a las APIs actuales.

Cada ejercicio es una suite de PHPUnit que **falla a propósito** hasta que lo
resuelves. La rama [`solucion`](https://github.com/jaisato/sf3-architecture-kata/tree/solucion) los tiene resueltos;
mírala cuando hayas terminado o si te atascas.

## Requisitos

- PHP 8.4 o superior, con la extensión `intl`.
- Composer 2.

```bash
git clone https://github.com/jaisato/sf3-architecture-kata.git
cd sf3-architecture-kata
composer install
composer test:smoke     # el kernel arranca y las rutas cargan: debe pasar ya
composer exercise1      # y así hasta exercise5; `composer test` ejecuta todo
```

## Ejercicio 1: componentes de PHP

**Implementa** las clases de `App\Component\Php` (`src/Component/Php`). Los
métodos que devuelven un valor lanzan una `LogicException` («TODO») hasta que
los completas.

| Clase | Componente | Pistas |
|---|---|---|
| `ExpressionLanguageDecorator` | ExpressionLanguage | `evaluate()` y `compile()`. El compilador pone paréntesis: `2 + 1` da `(2 + 1)`. |
| `IntlDecorator` | Intl | `Currencies`, `Languages` y `Countries`. La clase `Intl` de Symfony 3 ya no ofrece estos datos. |
| `OptionsResolverDecorator` | OptionsResolver | `host` y `company` obligatorias, `port` opcional y `name` con el valor por defecto `Jhon Snow`. |
| `PropertyAccessDecorator` | PropertyAccess | `PropertyAccess::createPropertyAccessor()`. Los índices de un array van entre corchetes. |
| `PropertyInfoExtractorDecorator` | PropertyInfo y TypeInfo | `getType()` devuelve un `Symfony\Component\TypeInfo\Type` (`getTypes()` está obsoleto). Las descripciones salen del PHPDoc. |
| `SerializerDecorator` | Serializer | Prepara también `Serializer\Car`: el serializador tiene que poder leer sus propiedades privadas. |

**Comprueba:** `composer exercise1`.
**Cuestionario:** [preguntas de componentes de PHP](questions_php.md).

## Ejercicio 2: Filesystem y Finder

**Implementa** las clases de `App\Component\Filesystem`
(`src/Component/Filesystem`). Un `Finder` acumula cada `in()` y cada filtro
que recibe, así que cada búsqueda empieza con uno nuevo (`Finder::create()`).

**Comprueba:** `composer exercise2`.
**Cuestionario:** [preguntas de Filesystem](questions_filesystem.md).

## Ejercicio 3: un bundle reutilizable

**Crea** un bundle siguiendo las
[buenas prácticas de los bundles reutilizables](https://symfony.com/doc/7.4/bundles/best_practices.html):

- La empresa es Acme y el bundle se llama Blog: `Acme\BlogBundle\AcmeBlogBundle`.
- Usa la estructura moderna. El bundle vive en `bundles/AcmeBlogBundle/`, con
  el código PHP en `src/` y los recursos en su raíz: `config/`, `public/` y
  `translations/`. `getPath()` tiene que devolver esa raíz: `AbstractBundle`
  ya lo hace, y si extiendes `Bundle` tendrás que sobrescribirlo.
- Una extensión del contenedor: `Acme\BlogBundle\DependencyInjection\AcmeBlogExtension`.
- Un controlador `Acme\BlogBundle\Controller\TopicController` que extienda
  `AbstractController` (la antigua clase `Controller` ya no existe).
- Un comando `Acme\BlogBundle\Command\TopicCommand`. Puede extender `Command`
  o, desde Symfony 7.3, ser una clase invocable con `#[AsCommand]`.
- Registra el namespace en el autoload de `composer.json`
  (`"Acme\\BlogBundle\\": "bundles/AcmeBlogBundle/src/"`, y después
  `composer dump-autoload`) y el bundle en `config/bundles.php`.

**Comprueba:** `composer exercise3`.

## Ejercicio 4: rutas

**Crea** en `TopicController` estas rutas:

- `GET /topics`, que debe responder 200.
- `POST /topics`, que debe responder con un 2xx: 200, o 201 si crea el tema.

Si el controlador es un servicio autoconfigurado con `#[Route]`,
`config/routes.yaml` (`resource: routing.controllers`) importa sus rutas sin
nada más. Un bundle también puede ofrecer su propio fichero de rutas para que
la aplicación lo importe.

**Comprueba:** `composer exercise4`.

## Ejercicio 5: contenedor de servicios

**Implementa:**

- Una extensión propia, `Acme\BlogBundle\DependencyInjection\CustomExtension`,
  que el bundle use en lugar de la que Symfony busca por convención.
- Una clase de servicio `TopicManager` en el bundle, registrada con el id
  `acme.blog.topic_manager` desde la configuración que carga `CustomExtension`.
  Escribe esa configuración en PHP o en YAML: Symfony 7.4 marca el formato XML
  como obsoleto.

Los servicios son privados por defecto. El test usa `static::getContainer()`,
el contenedor de test, que llega también a los servicios privados que
sobreviven a la compilación. Un servicio privado que nadie usa se elimina, así
que hazlo público o, mejor, úsalo (por ejemplo, desde el controlador).

**Comprueba:** `composer exercise5`.

## Calidad y CI

```bash
composer check          # lo que ejecuta el CI, en orden y con el PHP local
composer cs:fix         # corrige el estilo
```

`composer check` ejecuta `composer validate --strict`, `composer audit`,
php-cs-fixer, PHPStan, los lints y la suite: `smoke` en `master` y la entera en
`solucion`.

El CI (`.github/workflows/ci.yml`) usa el workflow reutilizable
[`symfony-ci`](https://github.com/jaisato/.github) de `jaisato/.github`:
`composer validate --strict`, `php -l` en PHP 8.4 y 8.5, php-cs-fixer, PHPStan
(nivel max), los lints, la suite `smoke` y `composer audit`. Las suites de los
ejercicios no corren en `master`, porque fallarían siempre. En la rama
`solucion`, el mismo workflow ejecuta la suite entera. `audit.yml` repite la
auditoría cada lunes y Dependabot propone las actualizaciones. Ver
[`SECURITY.md`](SECURITY.md).

### La rama `solucion`

`solucion` desciende de `master`: es `master` con los ejercicios resueltos.
`solucion.yml` comprueba que siguen teniendo solución en cada pull request a
`master`, cada lunes y a mano: fusiona el commit en prueba sobre `solucion` y
pasa la suite entera y `composer audit`. No es un check obligatorio.

`solucion` se pone al día integrando `master` con un merge, nunca con un
rebase, para que siga descendiendo de `master`:

```bash
git switch solucion
git merge master        # los conflictos se resuelven aquí
composer check          # en solucion, con la suite entera
git push
```

Si `solucion.yml` avisa de conflictos en una pull request, se puede integrar
de la misma forma su rama antes de fusionarla, o `master` justo después.

## La arquitectura de Symfony, en 2026

La kata venía con una presentación de 2017 (`presentation.pptx`, sobre
Symfony 3). Ya no está en el repositorio: era un binario de 3,8 MB que no se
podía revisar en un diff y hablaba de piezas que ya no existen. Sigue en el
historial (`git show 65eb4ae:presentation.pptx > presentation.pptx`). Esto es
lo que sigue vigente:

- **HttpKernel dirigido por eventos.** `HttpKernel::handle()` despacha
  `kernel.request` (seguridad y routing), resuelve el controlador
  (`kernel.controller`) y sus argumentos (`kernel.controller_arguments`), lo
  ejecuta, convierte lo que no sea una `Response` (`kernel.view`), deja
  retocar la respuesta (`kernel.response`) y cierra con
  `kernel.finish_request` y, ya enviada, `kernel.terminate`. Las excepciones
  pasan por `kernel.exception`.
- **EventDispatcher.** Patrón mediador, con listeners (hoy con
  `#[AsEventListener]`) y subscribers (`EventSubscriberInterface`).
- **Bundles y componentes.** Un bundle empaqueta una funcionalidad
  reutilizable; los componentes se usan también fuera del framework.

Lo que ya no existe: la Standard Edition y el `AppBundle` (desde Symfony 4,
Flex y `symfony/skeleton`), el componente ClassLoader (eliminado en 4.0),
`ContainerAwareEventDispatcher` (4.0), la integración de Templating con
FrameworkBundle (eliminada en 5.0; el componente `symfony/templating` se
publicó hasta la 6.4, y su última versión es la 6.4.24, de julio de 2025) y el
`ParamConverter` de SensioFrameworkExtraBundle, abandonado y sustituido por
los value resolvers de los argumentos de los controladores.
