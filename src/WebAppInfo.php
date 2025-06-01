<?php
namespace Botfire;

/**
 * Represents information about a Web App.
 */
class WebAppInfo {
    /**
     * @var string $url An HTTPS URL of a Web App to be opened with additional data as specified in Telegram's documentation.
     */
    private string $url;

    /**
     * Constructor to initialize the WebAppInfo object.
     *
     * @param string $url An HTTPS URL of a Web App.
     */
    public function __construct(string $url) {
        $this->setUrl($url);
    }

    /**
     * Get the Web App URL.
     *
     * @return string
     */
    public function getUrl(): string {
        return $this->url;
    }

    /**
     * Set the Web App URL.
     *
     * @param string $url An HTTPS URL of a Web App.
     * @return void
     */
    public function setUrl(string $url): void {
        if (!filter_var($url, FILTER_VALIDATE_URL) || stripos($url, 'https://') !== 0) {
            throw new \InvalidArgumentException("The URL must be a valid HTTPS URL.");
        }
        $this->url = $url;
    }


    /**
     * Convert the WebAppInfo object to an array for API requests.
     *
     * @return array
     */
    public function toArray(): array {
        return [
            'url' => $this->url,
        ];
    }
}