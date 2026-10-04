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
d) $accessor->getValue($object, 'getPrice()');
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
b) Solo `address`.
c) `name` y `address`.
d) Ninguna: lanza una excepción por el atributo desconocido `age`.

---

### Respuestas

1. **d)** `RuntimeException`: *Unable to get property "apple" of non-object "fruit".*
2. **d)** El compilador traduce el array literal a sintaxis PHP con índices explícitos y pone paréntesis en cada operación binaria.
3. **b)** Los datos vienen de ICU y se distribuyen con el componente; el locale por defecto lo da `\Locale::getDefault()`, de la extensión `intl`.
4. **c)** PropertyAccess usa el getter (`getPrice()`) sin que haya que nombrarlo.
5. **c)** Sin getters ni setters, `ReflectionExtractor` solo lista las propiedades públicas.
6. **b)** `name` es privada y no tiene setter, `lastName` no viene en el XML y `age` no existe: con `allow_extra_attributes` a `true`, el valor por defecto, se ignora.

