## Filesystem y Finder (Symfony 7.4)

**1) Con Finder, ¿cómo se buscan los ficheros que contienen un texto?**

```php
a) No se puede.
b) $finder->files()->contains('lorem ipsum');
c) $finder->files()->with('lorem ipsum');
d) Hay que recorrer los ficheros y leer cada uno.
```

**2) Con Finder, ¿cómo se obtienen los directorios ordenados por nombre?**

```php
a) No se pueden ordenar.
b) $finder->directories()->orderBy('name');
c) $finder->directories()->sortByName();
d) $finder->directories()->orderByName();
```

**3) Con Filesystem, ¿cómo se crea un directorio con permisos 0777?**

```php
a) $filesystem->create('/tmp/dir')->chmod(0777);
b) $filesystem->mkdir('/tmp/dir', '0777');
c) $filesystem->mkdir('/tmp/dir', 0777);
d) $filesystem->createDirectory('/tmp/dir')->chmod(0777);
```

Y una pregunta extra: con una `umask` de `022`, ¿qué permisos acaba teniendo
el directorio de la respuesta correcta?
