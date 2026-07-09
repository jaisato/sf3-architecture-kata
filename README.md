# KATA SYMFONY 3

The goal of this kata is work your knowledge about "Symfony architecture" of [Symfony certification](https://sensiolabs.com/en/symfony/certification.html)

> **Security note:** This kata targets Symfony 3.2 and PHP 5.5.9, which are both end-of-life and have known unpatched CVEs. Upgrading to a supported Symfony (LTS) and PHP version is recommended. Also, `phpunit/phpunit` should be moved to `require-dev` in `composer.json` (left as a recommendation here to avoid invalidating `composer.lock`).

#### Exercise 1:
**Implement:** Classes of namespace "Component\PHP"
**Check:** php vendor/bin/phpunit --testsuirce=exercise1
**Test**: Answer the next [questions](questions_php.md)

#### Exercise 2:
**Implement:** Classes of namespace "Component\Filesystem"
**Check:** php vendor/bin/phpunit --testsuirce=exercise2
**Test**: Answer the next [questions](questions_filesystem.md)

#### Exercise 3:
**Implement:**
Add a reusable bundle to the kernel using best practices:

    - Our company name is Acme
    - Bundle name is "Blog"
    - Has a controller about "Topic"
    - Has a command about "Topic"
    - Has the next resource directories: public, translations, config.
    
**Check:** php vendor/bin/phpunit --testsuirce=exercise3

#### Exercise 4:
Create the next routes to your controller:
    - POST /topics
    - GET /topics

**Check:** php vendor/bin/phpunit --testsuirce=exercise4    

#### Exercise 5:
**Implement:**

    - Create a custom extension in your bundle named CustomExtension
    - Create a service class "TopicManager" inside your bundle and add to the services (use CustomExtension to load)

**Check:** php vendor/bin/phpunit --testsuirce=exercise5
