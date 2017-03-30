## Components 

#### Filesystem
**1) Using Finder. What do you do if you want to get a specific file with a specific content?** 
```php
a) It's not possible
b) $finder->files()->contains('lorem ipsum')
c) $finder->files()->with('lorem ipsum')
d) Restrict files and iterate in order to get it.
```

**2) Using Finder. How do you get a Finder with ordered list of directories by name?
```php
a) You cannot order directories
b) $finder->directories($path)->orderBy('name')
c) $finder->directories()->orderByFileName('name')
d) $finder->directories()->orderByName()
```

3) Using Filesystem. How do you create a directory with permissions 777?
```php
a) $filesystem->create('/tmp/dir')->chmod(777);
b) $filesystem->create('/tmp/dir', '0777');
c) $filesystem->mkdir('/tmp/dir', 0700);
d) $filesystem->createDirectory('/tmp/dir')->chmod(0777);
```
