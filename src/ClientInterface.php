<?php

declare(strict_types=1);

namespace Sentry;

use Sentry\Integration\IntegrationInterface;
use Sentry\State\Scope;
use Sentry\Transport\TransportInterface;

/**
 * This interface must be implemented by all Sentry client classes.
 *
 * @author Stefano Arlandini <sarlandini@alice.it>
 */
interface ClientInterface
{
    /**
     * Returns the options of the client.
     *
     * @return Options
     */
    public function getOptions(): Options;

    /**
     * Returns the transport of the client.
     *
     * @return TransportInterface
     */
    public function getTransport(): TransportInterface;

    /**
     * Logs a message.
     *
     * @param string     $message The message (primary description) for the event
     * @param Severity   $level   The level of the message to be sent
     * @param Scope|null $scope   An optional scope keeping the state
     *
     * @return string|null
     */
    public function captureMessage(string $message, ?Severity $level = null, ?Scope $scope = null): ?string;

    /**
     * Logs an exception.
     *
     * @param \Throwable $exception The exception object
     * @param Scope|null $scope     An optional scope keeping the state
     *
     * @return string|null
     */
    public function captureException(\Throwable $exception, ?Scope $scope = null): ?string;

    /**
     * Logs the most recent error (obtained with {@link error_get_last}).
     *
     * @param Scope|null $scope An optional scope keeping the state
     *
     * @return string|null
     */
    public function captureLastError(?Scope $scope = null): ?string;

    /**
     * Captures a new event using the provided data.
     *
     * @param array      $payload The data of the event being captured
     * @param Scope|null $scope   An optional scope keeping the state
     *
     * @return string|null
     */
    public function captureEvent(array $payload, ?Scope $scope = null): ?string;

    /**
     * Returns the integration instance if it is installed on the Client.
     *
     * @param string $className the classname of the integration
     *
     * @return IntegrationInterface|null
     */
    public function getIntegration(string $className): ?IntegrationInterface;
}
