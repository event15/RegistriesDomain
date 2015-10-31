<?php

use Behat\Behat\Tester\Exception\PendingException;
use Behat\Behat\Context\Context;
use Behat\Behat\Context\SnippetAcceptingContext;
use Behat\Gherkin\Node\PyStringNode;
use Behat\Gherkin\Node\TableNode;

/**
 * Defines application features from the specific context.
 */
class FeatureContext implements Context, SnippetAcceptingContext
{
    /**
     * Initializes context.
     *
     * Every scenario gets its own context instance.
     * You can also pass arbitrary arguments to the
     * context constructor through behat.yml.
     */
    public function __construct()
    {
    }

    /**
     * @When I add a new car following data:
     */
    public function iAddANewCarFollowingData(TableNode $table)
    {
        throw new PendingException();
    }

    /**
     * @Then :arg1 list should contain following data:
     */
    public function listShouldContainFollowingData($arg1, TableNode $table)
    {
        throw new PendingException();
    }
}
