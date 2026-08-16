# Estado de seguridad de las dependencias

## Qué se ha corregido

`composer audit` informaba de **63 advisories en 5 paquetes**. Actualizando
dentro de las ramas compatibles quedan **42 en 7 paquetes**:

| Paquete | Antes | Ahora | Efecto |
|---------|-------|-------|--------|
| `symfony/symfony` | v3.2.6 | v3.4.49 | 42 → 21 advisories |
| `twig/twig` | v2.3.0 | v2.16.1 | 18 → 15 advisories |
| `doctrine/orm` | v2.5.6 | 2.7.5 | — |
| `phpunit/phpunit` | 5.7.17 | 5.7.27 | — |
| `swiftmailer/swiftmailer` | v5.4.6 | v5.4.12 | — |

3.4.49 es la **última** versión publicada de la rama 3.4, y 2.16.1 la última de
Twig 2.x. No hay nada más que actualizar sin cambiar de versión mayor.

## Por qué quedan 42

Los avisos restantes afectan a **toda** la rama 3.x de Symfony y a **toda** la
2.x de Twig: por ejemplo CVE-2026-48489 (alta) se corrige en 5.4.53, 6.4.41 y
7.4.13, y no existe una 3.x corregida. Symfony 3.4 dejó de recibir soporte de
seguridad en **noviembre de 2021**; Twig 2.x está igualmente descontinuada.

**No se pueden cerrar actualizando.** La corrección real es migrar a una rama
con soporte (Symfony 6.4 LTS o 7.x, Twig 3.x), lo que en este proyecto supone
rehacer la estructura de la aplicación -`AppKernel`, `app/config/*.yml`, los
bundles `sensio/*` abandonados- y no es un cambio de dependencias.

Este repositorio es una kata de arquitectura de 2017: conviene tratarlo como
material de estudio, **no como algo desplegable**.

## Versión de PHP

`composer.json` declara ahora:

- `require.php = ">=7.1.3"`
- `config.platform.php = "7.1.3"`

Los dos valores coinciden **a propósito**. `platform` hace que Composer resuelva
como si el intérprete fuese esa versión, así que si `require.php` admitiera
menos que `platform` (declaraba `>=5.5.9`), una instalación sobre PHP 5.5–7.1.2
pasaría la verificación de plataforma y luego reventaría en tiempo de ejecución:
el conjunto bloqueado incluye Twig 2.16.1 y los contratos de Symfony, que exigen
PHP >= 7.1.3.

7.1.3 es el suelo real del `composer.lock`, no una elección arbitraria: es el
mayor de los mínimos que declaran los paquetes bloqueados.

Fijar `platform` sigue siendo necesario para que el lock sea reproducible: sin
ello la resolución depende del PHP de quien ejecute `composer`, y en un PHP 8.4
moderno `composer update` falla directamente.

## Paquetes abandonados

`sensio/distribution-bundle`, `sensio/framework-extra-bundle`,
`sensio/generator-bundle`, `sensiolabs/security-checker`,
`swiftmailer/swiftmailer` y `symfony/swiftmailer-bundle` están abandonados.
Sustituirlos forma parte de la misma migración.
