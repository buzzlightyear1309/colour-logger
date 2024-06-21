<?php

namespace App\Logging;

use Monolog\Logger;
use Monolog\Handler\StreamHandler;
use Monolog\Formatter\LineFormatter;

/**
 * Class ColourLogger
 * Provides a fluent API for coloured logging in console applications.
 */
class ColourLogger
{
    protected static ?ColourLogger $instance = null;
    protected Logger $logger;
    protected string $format;
    protected array $styles = [];
    protected array $colour_map = [
        'black' => '0',
        'red' => '1',
        'green' => '2',
        'yellow' => '3',
        'blue' => '4',
        'magenta' => '5',
        'cyan' => '6',
        'white' => '7',
        'bright_black' => '8',
        'bright_red' => '9',
        'bright_green' => '10',
        'bright_yellow' => '11',
        'bright_blue' => '12',
        'bright_magenta' => '13',
        'bright_cyan' => '14',
        'bright_white' => '15',
        'grey' => '16',
        'navy' => '17',
        'dark_blue' => '18',
        'dark_green' => '22',
        'teal' => '6',
        'lime_green' => '10',
        'purple' => '53',
        'orange' => '202',
        'maroon' => '88',
        'olive' => '58',
        'brown' => '94',
        'light_gray' => '249',
        'medium_gray' => '245',
        'charcoal' => '238',
        'violet' => '92',
        'light_blue' => '153',
        'light_green' => '154',
        'light_cyan' => '195',
        'light_red' => '203',
        'light_magenta' => '207',
        'light_yellow' => '227',
        'neon_green' => '118',
        'turquoise' => '44',
        'salmon' => '209',
        'beige' => '230',
        'mint_green' => '48',
        'lavender' => '183',
    ];

    /**
     * Protected constructor to prevent creating a new instance from outside.
     * @param string $channel_name Name of the logging channel.
     */
    protected function __construct(string $channel_name = 'app')
    {
        $this->logger = new Logger($channel_name);
        $handler = new StreamHandler('php://stdout', Logger::DEBUG);
        $this->logger->pushHandler($handler);
        $this->format = "%message%\n";
    }

    /**
     * Singleton access to the logger instance.
     * @return ColourLogger
     */
    public static function getInstance(): ColourLogger
    {
        if (!self::$instance) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    /**
     * Set the text colour.
     * @param string $colour The colour name.
     * @return ColourLogger
     */
    public static function text(string $colour): ColourLogger
    {
        return self::getInstance()->setTextColour($colour);
    }

    protected function setTextColour($colour): static
    {
        if (isset($this->colour_map[$colour])) {
            $this->styles['text_colour'] = '38;5;' . $this->colour_map[$colour];
        }
        return $this;
    }

    /**
     * Set the background colour.
     * @param string $colour The colour name.
     * @return ColourLogger
     */
    public static function background(string $colour): ColourLogger
    {
        return self::getInstance()->setBackgroundColour($colour);
    }

    protected function setBackgroundColour($colour): static
    {
        if (isset($this->colour_map[$colour])) {
            $this->styles['background_colour'] = '48;5;' . $this->colour_map[$colour];
        }
        return $this;
    }

    /**
     * Apply bold style to the text.
     * @return ColourLogger
     */
    public static function bold(): ColourLogger
    {
        return self::getInstance()->setBold();
    }

    protected function setBold(): static
    {
        $this->styles['bold'] = '1';
        return $this;
    }

    /**
     * Apply italic style to the text.
     * @return ColourLogger
     */
    public static function italic(): ColourLogger
    {
        return self::getInstance()->setItalic();
    }

    protected function setItalic(): static
    {
        $this->styles['italic'] = '3';
        return $this;
    }

    /**
     * Underline the text.
     * @return ColourLogger
     */
    public static function underline(): ColourLogger
    {
        return self::getInstance()->setUnderline();
    }

    protected function setUnderline(): static
    {
        $this->styles['underline'] = '4';
        return $this;
    }

    /**
     * Log a message with styles applied.
     * @param string $message The message to log.
     * @param array $context Additional information for the log.
     * @return ColourLogger
     */
    public static function log(string $message, array $context = []): ColourLogger
    {
        return self::getInstance()->executeLog($message, $context);
    }

    protected function executeLog($message, array $context = []): static
    {
        $this->applyFormat();
        $this->logger->info($message, $context);
        $this->styles = []; // Reset styles after logging
        return $this;
    }

    protected function applyFormat(): void
    {
        if (!empty($this->styles)) {
            $styleCode = implode(';', $this->styles);
            $this->format = "\033[" . $styleCode . "m%message%\033[0m\n";
        } else {
            $this->format = "%message%\n";
        }

        $formatter = new LineFormatter($this->format, null, true, true);
        $this->logger->getHandlers()[0]->setFormatter($formatter);
    }
}
