<?php
namespace PhpMvc;

/**
 * Provides a way to return an action result with a specific HTTP response status code and description.
 */
class HttpStatusCodeResult implements ActionResult {

    /**
     * Gets the HTTP status code.
     * 
     * @var int
     */
    private $statusCode;

    /**
     * Gets the HTTP status description.
     * 
     * @var string
     */
    private $statusDescription;

    /**
     * Initializes a new instance of HttpStatusCodeResult.
     * 
     * @param int $statusCode The HTTP status code.
     * @param string $statusDescription The HTTP status description.
     */
    public function __construct($statusCode, $statusDescription = null) {
        $this->statusCode = $statusCode;
        $this->statusDescription = $statusDescription;
    }

    /**
     * Executes the action and outputs the result.
     * 
     * @param ActionContext $actionContext The context in which the result is executed.
     * The context information includes information about the action that was executed and request information.
     * 
     * @return void
     */
    public function execute($actionContext) {
        if (empty($this->statusDescription)) {
            http_response_code($this->statusCode);
        }
        else {
            $protocol = (isset($_SERVER['SERVER_PROTOCOL']) ? $_SERVER['SERVER_PROTOCOL'] : 'HTTP/1.0');
            header($protocol . ' ' . $this->statusCode . ' ' . $this->statusDescription);
            $GLOBALS['http_response_code'] = $this->statusCode;
        }

        exit;
    }

}