## Componentes de PHP (Symfony 7.4)

**1) Con ExpressionLanguage, ¿qué hace este código?**

```php
$expressionLanguage->evaluate('fruit.apple', ['fruit' => 'apple']);
```

a) Devuelve `'fruit'`.
b) Devuelve `['fruit' => 'apple']`.
c) Devuelve `'apple'`.
d) Lanza una excepción: no se puede leer una propiedad de algo que no es un objeto.

**2) Con ExpressionLanguage, ¿qué imprime este código?**

```php
var_dump($expressionLanguage->compile('[1 + 3]'));
```

a) `string(7) "[1 + 3]"`
b) `string(1) "4"`
c) `int(4)`
d) `string(14) "[0 => (1 + 3)]"`

**3) ¿Qué afirmación sobre el componente Intl es correcta?**

a) Sustituye a la extensión `intl` de PHP.
b) Da acceso a los datos de ICU (nombres de idiomas, países, monedas, zonas horarias…) con clases como `Currencies`, `Languages` o `Countries`.
c) Solo devuelve nombres en inglés.
d) Hay que instalar un paquete distinto para cada idioma.

**4) Con PropertyAccess, ¿cómo se lee la propiedad privada `price` de un objeto que tiene un método público `getPrice()`?**

```php
a) $accessor->getValue($object, 'object[0].price');
b) $accessor->getValue($object, 'object.price');
c) $accessor->getValue($object, 'price');
d) $accessor->getValue($object, 'get_price');
```

**5) Con PropertyInfo y un `ReflectionExtractor` sin configurar, ¿qué devuelve `getProperties()` para esta clase?**

```php
class Car
{
    private $name;
    private $lastName;
    public $address;
}

$reflectionExtractor->getProperties(Car::class);
```

a) `['name', 'lastName', 'address']`
b) `['name' => null, 'lastName' => null, 'address' => null]`
c) `['address']`
d) `null`

**6) Con un Serializer con `ObjectNormalizer` y `XmlEncoder`, ¿qué propiedades de `$person` quedan con valor?**

```php
class Person
{
    private $name;
    private $lastName;
    public $address;

    public function setAddress($address)
    {
        $this->address = $address;
    }
}

$data = <<<XML
<person>
    <name>foo</name>
    <age>99</age>
    <address>Catalonia</address>
</person>
XML;

$person = $serializer->deserialize($data, Person::class, 'xml');
```

a) `name`, `lastName` y `address`.
b) Solo `address`: el normalizador escribe en las propiedades públicas y a través de los setters, e ignora `age`.
c) `name` y `address`.
d) Ninguna: lanza una excepción por el atributo desconocido `age`.
