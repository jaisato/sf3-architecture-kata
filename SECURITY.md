# Estado de seguridad de las dependencias

## Qué se ha corregido

`composer audit` informaba de **63 advisories en 5 paquetes**. Actualizando
dentro de las ramas compatibles quedan **38 en 3 paquetes**:

| Paquete | Antes | Ahora | Efecto |
|---------|-------|-------|--------|
| `symfony/symfony` | v3.2.6 | v3.4.49 | 42 → 21 advisories |
| `twig/twig` | v2.3.0 | v2.16.1 | 18 → 15 advisories |
| `doctrine/orm` | v2.5.6 | 2.7.5 | — |
| `phpunit/phpunit` | 5.7.17 | 8.5.54 | 1 → **0** |
| `swiftmailer/swiftmailer` | v5.4.6 | v6.3.0 | 1 → **0** |
| `symfony/swiftmailer-bundle` | v2.6.7 | v3.3.1 | — (necesario para lo anterior) |
| `symfony/http-client` | v4.4.51 | v5.4.53 | 1 → **0** |
| `symfony/polyfill-intl-idn` | v1.30.0 | v1.38.1 | 1 → **0** |
| `symfony/mime` | v4.4.47 | v5.4.13 | 2 → 2 (ver abajo) |

3.4.49 es la **última** versión publicada de la rama 3.4, y 2.16.1 la última de
Twig 2.x.

## Los 38 que quedan, paquete por paquete

### `symfony/symfony` (21) y `twig/twig` (15) — sin corrección posible

Afectan a **toda** la rama 3.x de Symfony y a **toda** la 2.x de Twig: por
ejemplo CVE-2026-48489 (alta) se corrige en 5.4.53, 6.4.41 y 7.4.13, y no existe
una 3.x corregida. Symfony 3.4 dejó de recibir soporte de seguridad en
**noviembre de 2021**; Twig 2.x está igualmente descontinuada.

**No se pueden cerrar actualizando.** La corrección real es migrar a una rama
con soporte (Symfony 6.4 LTS o 7.x, Twig 3.x), lo que en este proyecto supone
rehacer la estructura de la aplicación -`AppKernel`, `app/config/*.yml`, los
bundles `sensio/*` abandonados- y no es un cambio de dependencias.

### `symfony/mime` (2) — bloqueado por el monolito

CVE-2026-45067 (alta) y CVE-2026-45070 (media) se corrigen en 5.4.52, pero:

```
symfony/mime v5.4.52 conflicts with symfony/serializer <5.4.35
(symfony/symfony v3.4.49 replaces symfony/serializer self.version)
```

El paquete monolítico sustituye a `symfony/serializer` por su versión 3.4.49, y
mime 5.4.52 declara conflicto con cualquier serializer anterior a 5.4.35. Se ha
llegado a 5.4.13, el máximo antes del conflicto. Sale con la misma migración.

`symfony/mime` no lo usa el código de la aplicación: entra por
`sensiolabs/security-checker`.

### De dónde venían los otros

`sensio/distribution-bundle` → `sensiolabs/security-checker` → `symfony/http-client`
+ `symfony/mime` → `symfony/polyfill-intl-idn`.

Conviene señalarlo: **cuatro de los seis advisories ajenos al framework entraban
por `sensiolabs/security-checker`**, una herramienta abandonada cuya función
-avisar de dependencias vulnerables- la hace hoy `composer audit`, incluido en
Composer. Retirar `sensio/distribution-bundle` se llevaría toda esa rama, pero
es parte del esqueleto Symfony 3 y pertenece a la migración.

### `phpunit/phpunit` — corregido, con una advertencia

CVE-2026-24765 (alta, deserialización insegura en la cobertura de PHPT) se
corrige en 8.5.52. Se ha subido de 5.7.27 a **8.5.54** y, de paso, se ha movido
de `require` a `require-dev`: un lanzador de tests no pertenece a las
dependencias de producción.

PHPUnit 8 exige el tipo de retorno `void` en `setUp()`, así que ocho ficheros de
test lo declaran ahora. **No ha sido posible comprobar que la suite quede en
verde**: el entorno de revisión corre PHP 8.4, fuera del rango `<8.0` que este
lock admite, y no hay disponible ningún PHP 7.x ni runtime de contenedores. Lo
que sí se ha comprobado es que la suite **carga y se ejecuta** (39 tests
recogidos); los fallos que aparecen son incompatibilidades de Symfony 3.4 con
PHP 8 -«Trying to access array offset on null», «Unknown format specifier»,
componentes devolviendo `null`-, no del cambio de versión. Conviene ejecutarla
una vez sobre PHP 7.2–7.4 antes de dar por buena esta parte.

Este repositorio es una kata de arquitectura de 2017: conviene tratarlo como
material de estudio, **no como algo desplegable**.

## Versión de PHP

`composer.json` declara ahora:

- `require.php = ">=7.2.5 <8.0"`
- `config.platform.php = "7.2.5"`

Los dos valores coinciden **a propósito**. `platform` hace que Composer resuelva
como si el intérprete fuese esa versión, así que si `require.php` admitiera
menos que `platform` (declaraba `>=5.5.9`), una instalación sobre PHP 5.5–7.1.2
pasaría la verificación de plataforma y luego reventaría en tiempo de ejecución:
el conjunto bloqueado incluye Twig 2.16.1 (>= 7.1.3) y, tras esta ronda,
`symfony/http-client` 5.4.53 y `symfony/mime` 5.4.13 (>= 7.2.5).

El suelo subió de 7.1.3 a **7.2.5** a propósito: 7.1.3 era justo lo que impedía
actualizar `symfony/polyfill-intl-idn` (1.38.1 exige >= 7.2) y
`symfony/http-client` (5.4.x exige >= 7.2.5), dos de los advisories ahora
cerrados. Estrechar el rango declarado a cambio de cerrarlos es razonable en un
proyecto que no es desplegable: PHP 7.1 perdió soporte en diciembre de 2019.

**7.2.5 es el suelo real del `composer.lock`**, no una elección arbitraria: es
el mayor de los mínimos que declaran los paquetes bloqueados
-`symfony/service-contracts`, `symfony/http-client`,
`symfony/http-client-contracts` y `symfony/mime` exigen todos `>= 7.2.5`-. Twig
2.16.1, que marcaba el suelo anterior de 7.1.3, ya no es el más exigente.

El **techo** es igual de necesario. Sin `<8.0`, un PHP 8.x quedaba declarado
como soportado, y como `platform` finge un 7.2.5 la instalación se completaba
sin quejarse — pero el conjunto bloqueado no funciona ahí:
`doctrine/doctrine-cache-bundle` exige `^7.1` y PHPUnit `^5.6 || ^7.0`.
`composer check-platform-reqs --lock` sobre PHP 8.4 lo confirma:

```
php   8.4.19   doctrine/doctrine-cache-bundle requires php (^7.1)   failed
```

Es decir: el rango declarado ahora coincide con lo que el lock puede ejecutar
de verdad, ni más abajo ni más arriba. Subir de ahí es la migración a una rama
con soporte que se describe arriba.

Fijar `platform` sigue siendo necesario para que el lock sea reproducible: sin
ello la resolución depende del PHP de quien ejecute `composer`, y en un PHP 8.4
moderno `composer update` falla directamente.

### El punto ciego de `platform`, y cómo se tapa

`config.platform` tiene un efecto secundario incómodo: Composer valida **todas**
las restricciones -incluida `require.php`- contra ese 7.2.5 sintético y no
contra el intérprete real, así que `composer install` en un PHP 8 se completa
sin una queja y la aplicación falla después, al ejecutarse. El rango declarado,
por sí solo, no impide nada.

Por eso `bin/check-php-version.php` corre en `pre-install-cmd` y
`pre-update-cmd`: se ejecuta sobre el intérprete de verdad, sin shim, y aborta
antes de instalar nada. En este entorno (PHP 8.4.19) devuelve código 1.

### `allow-plugins`

`doctrine/orm` 2.7.5 arrastra `composer/package-versions-deprecated`, de tipo
`composer-plugin`. Desde Composer 2.2 un plugin no declarado se bloquea y, en
modo no interactivo -CI, despliegue-, la instalación **aborta** en vez de
limitarse a omitirlo. Queda permitido de forma explícita y acotada a ese
paquete.

## Paquetes abandonados

`sensio/distribution-bundle`, `sensio/framework-extra-bundle`,
`sensio/generator-bundle`, `sensiolabs/security-checker`,
`swiftmailer/swiftmailer` y `symfony/swiftmailer-bundle` están abandonados.
Sustituirlos forma parte de la misma migración.
