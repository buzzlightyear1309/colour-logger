# ColourLogger

ColourLogger is a powerful, fluent API for coloured logging in PHP applications, leveraging Monolog to enhance readability and focus during development by adding coloured and styled text capabilities to console logging.

## Features

- Easy integration with any Laravel application.
- Fluent interface to configure foreground and background colours, as well as text styles such as bold, italic, and underline.
- Built on top of the robust Monolog logging library.
- Support for logging complex data types including arrays and objects, with optional pretty-print JSON formatting.

## Installation

Install ColourLogger via Composer:

```bash
composer require buzzlightyear/colour-logger
```

## Usage

Here is how you can use ColourLogger in your PHP projects:

```php
use App\Logging\ColourLogger;

// Basic usage
ColourLogger::text('blue')->log('This is a blue text');

// Complex styling
ColourLogger::text('blue')->background('red')->bold()->italic()->underline()->log('This message has red background and blue, bold, italic, underlined text');

// Logging complex data types with pretty-print JSON
ColourLogger::text('green')->json()->log(['key' => 'value', 'another_key' => 'another_value']);
```

## Customize Colours

You can easily customize the colours by accessing the `colour_map` array within the `ColourLogger` class. Modify this array to include your preferred ANSI colour codes.

## Contributing

Contributions are what make the open-source community such an amazing place to learn, inspire, and create. Any contributions you make are **greatly appreciated**.

To contribute to ColourLogger, follow these steps:

1. Fork the project repository.
2. Create a new branch (`git checkout -b feature/AmazingFeature`).
3. Make your changes.
4. Commit your changes (`git commit -m 'Add some AmazingFeature'`).
5. Push to the branch (`git push origin feature/AmazingFeature`).
6. Open a pull request.

## License

Distributed under the MIT License. See `LICENSE` file for more information.

## Contact

Project Link: [https://github.com/buzzlightyear1309/colour-logger](https://github.com/buzzlightyear1309/colour-logger)
