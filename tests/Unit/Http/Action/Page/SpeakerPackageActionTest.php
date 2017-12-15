<?php

declare(strict_types=1);

/**
 * Copyright (c) 2013-2017 OpenCFP
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 *
 * @see https://github.com/opencfp/opencfp
 */

namespace OpenCFP\Test\Unit\Http\Action\Page;

use OpenCFP\Http\Action\Page\SpeakerPackageAction;
use OpenCFP\Test\Unit\Http\Action\AbstractActionTestCase;
use Symfony\Component\HttpFoundation;

/**
 * @covers \OpenCFP\Http\Action\Page\SpeakerPackageAction
 */
final class SpeakerPackageActionTest extends AbstractActionTestCase
{
    public function testItReturnsTheContentOfTheTwigInAResponseObject()
    {
        $content = $this->faker()->text();
        $twig    = $this->createTwigMock();

        $twig
            ->expects($this->once())
            ->method('render')
            ->with(
                $this->identicalTo('package.twig')
            )
            ->willReturn($content);
        $action   = new SpeakerPackageAction($twig);
        $response = $action();
        $this->assertInstanceOf(HttpFoundation\Response::class, $response);
        $this->assertContains($content, $response->getContent());
        $this->assertSame(HttpFoundation\Response::HTTP_OK, $response->getStatusCode());
    }
}