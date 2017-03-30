## Components 

#### PHP
**1) Using OptionsResolver. What is the result the next code?** 
```php
echo $resolver->evaluate("'fruit.apple', ['fruit' => 'apple']);
```
a) fruit
b) ['fruit' => 'apple']
c) apple
d) Unable to get a property on a non-object
    
**2) Using OptionsResolver. What is the result the next code?** 
```php
var_dump($resolver->compile("[1 + 3]"));
```
a) string(7) "[1 + 3]"
b) string(1) "4"
c) int 4
d) string(19) "array(0 => (1 + 3))"

**3) What is the correct answer about Intl component?**
        a) Replaces native C intl library
        b) It's an abstraction of intl library and you have to install it in order to use for spanish language
        c) All previous
 
 **4) How can you access to a object's private attribute named "price" with a public method 'getPrice()' by PropertyAccess component?**
```php
    a) $accessor->getValue($object, 'object[0].price')
    b) $accessor->getValue($object, 'object.price')
    c) $accessor->getValue($object, 'price')
    d) $accessor->getValue($object, 'get_price')
```

5) What does prints the next code using the PropertyInfo component:
```php
	$car = new class {
	    private $name;
	    private $lastName;
	    public $address;
	}
```
a) array(name, lastName, address)
a) array(name => null, lastName => null, address => 'catalonia')
a) array(address)
a) array(address => 'catalonia')

**6) What affirmation is true about Serializer component?**
```php
class Person {
	private $name;
	private $lastName;
	public $address;
	public setAddress($address) {
	    $this->address = $address;
	}
}

$data = <<<EOF
<person>
    <name>foo</name>
    <age>99</age>
    <sportsman>false</sportsman>
</person>
EOF;

$person = $serializer->deserialize($data, Person::class, 'xml');
```
a) All attributes are setted
b) Only public attributes are setted
c) All public attributes and attributes with public method are setted
d) None of above