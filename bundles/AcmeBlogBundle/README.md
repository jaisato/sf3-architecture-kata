# AcmeBlogBundle

Solution to exercises 3, 4 and 5 of the kata: a reusable bundle with the
modern directory structure.

```
AcmeBlogBundle/
├── config/services.php     services, loaded by CustomExtension
├── public/                 web assets (assets:install)
├── src/                    PHP classes, namespace Acme\BlogBundle\
│   ├── AcmeBlogBundle.php
│   ├── Command/TopicCommand.php
│   ├── Controller/TopicController.php
│   ├── DependencyInjection/{AcmeBlogExtension,CustomExtension}.php
│   └── TopicManager.php
└── translations/
```
