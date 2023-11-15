# GHCrypt

This is a keyless encrypt/decrypt algorithm for plain text.


## Usage/Examples

```php
<?php
$text = "follow the white rabbit...";

	$myCrypt = new GHCrypt();
	$encrypt = $myCrypt -> enstring($text);
	$decrypt = $myCrypt -> destring($encrypt);

	echo "Plain-text: ".$text."\n";
	echo "Crypted: ".$encrypt."\n";
	echo "Decrypted: ".$decrypt."\n";

unset($myCrypt);
?>
```

## Demo

The result after two runs:

![App Screenshot](https://vargalaszlo.com/images/out/ghcrypt.png)

