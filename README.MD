# PHP vCard Library

This library can create a .vcf file or a string representation of a .vcf file with one or more vCards in it. All vCards are generated as a version 4.0 vCard.

## Usage
    <?php

    use JesseVooges\PHPvCard\Parsers\VCardParser;
    use JesseVooges\PHPvCard\Properties\Email;
    use JesseVooges\PHPvCard\Properties\FormattedName;
    use JesseVooges\PHPvCard\Properties\Name;
    use JesseVooges\PHPvCard\Properties\Organisation;
    use JesseVooges\PHPvCard\Properties\Telephone;
    use JesseVooges\PHPvCard\Properties\Title;
    use JesseVooges\PHPvCard\VCard;

    $properties = [
        new Name('Doe', 'John'),
        new Telephone('+1-202-555-0125 '),
        new Organisation('Company', 'Development'),
        new FormattedName('John Doe'),
        new Title('Developer'),
        new Email('email@example.org')
    ];

    $vCard = new VCard($properties);

    $vCardParser = new VCardParser($vCard);

    //Write to file
    $path = __DIR__;

    $vCardParser->toFile($path);

    //Show string representation
    echo $vCardParser->parse();

## vCard properties

- [x] FN (Full name): The full name of the object (as a single string). This is the only mandatory property.
- [x] N (Name): The name of the object represented in structured parts
- [x] NICKNAME: A nickname for the object
- [x] PHOTO
- [x] BDAY: Birth date of the object. Should only apply to Individual
- [x] ANNIVERSARY: Should only apply to Individual
- [x] GENDER: Should only apply to Individual

### Addressing:

- [x] ADDRESS: The address of the object

### Communication:

- [x] TEL: The telephone number(s)
- [x] EMAIL: The email address(es)
- [ ] IMPP: The IMPP instant messaging contact information
- [ ] LANG: The language of the object

### Geographical:

- [ ] TZ: The timezone of the object
- [x] GEO: The geographical coordinates

### Organizational:

- [x] TITLE: The title of the object
- [x] ROLE: The role of the object
- [x] LOGO: The logo of the object
- [x] ORG: The organisation related to the object
- [ ] MEMBER: Can only be used for Group Kind objects. Must point to other Individual or Organization objects.
- [ ] RELATED: Link to related objects.

### Explanatory:

- [x] CATEGORIES: The categories of the object
- [x] NOTE: Notes about the object
- [x] PRODID: The identifier of the product that created the vCard object
- [x] REV: The revision datetime of the vCard object
- [ ] SOUND: Audio related to the object
- [ ] UID: A unique identifier for the object
- [ ] CLIENTPIDMAP: Not required
- [x] URL: Any URL related to the object

### Security:

- [ ] KEY: The security key of the object

### Calendar:

- [x] FBURL: Calendar Busy Time of the object
- [x] CALADURI: Calendar Request of the object
- [x] CALURI: Calendar Link of the object
