
# TLV300- Home Assignment for Full Stack Developer

The Whois API is a service that provides comprehensive information about domain names including  details about domain registration ownership and contact information. This API allows users to retrieve  essential details about a given domain.


## API Reference

#### Get domain informations
```http
  GET /api/home
```

| Parameter | Type     | Description                |
| :-------- | :------- | :------------------------- |
| `domain_name` | `string` | **Required**. Domain name |


## Installation
Clone the project
```bash
  git clone git@github.com:heraldsuva/tlv300-api-test.git
```

Go to the project directory
```bash
  cd tlv300-api-test
```

Create the .env file
```bash
  cp .env.example .env
```

Install dependencies
```bash
  composer install
```

To run this project, you will need to add the following environment variables to your .env file and provide the value.
```bash
WHOIS_PROVIDER
WHOISXML_API_KEY
WHOISXML_API_URL
```
The `WHOIS_PROVIDER` is use by the `config/services.php` file on which third party api will consume by the system. The default value is `testing` where it generates only fake data due to limited access on  trial version of these third party services. I added another alternative for WhoisXMLAPI which is the `whoisfreaks` value to demonstrate on how to easily switch into another web service without changing much on the codebase. In that case these variables are need to be added also
```bash
WHOISFREAKS_API_KEY
WHOISFREAKS_API_URL
```

Start the server
```bash
  php artisan serve --port=8000
```

## Running Tests

To run tests, run the following command

```bash
  php artisan test
```

## Tech Stack
 - [Laravel 11](https://laravel.com)
 - [WhoisXMLAPI](https://www.whoisxmlapi.com)
 - [WhoisFreaks](https://www.whoisfreaks.com)
