<?php

/*
 * This file is part of the PHP Highcharts library.
 *
 * (c) University of Cambridge
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Misd\Highcharts\Test;

use Misd\Highcharts\AbstractChart;
use PHPUnit_Framework_TestCase as TestCase;

class AbstractChartTest extends TestCase
{
    /**
     * @return AbstractChart
     */
    protected function createChart()
    {
        return $this->getMockForAbstractClass('Misd\Highcharts\AbstractChart');
    }

    public function testGetId()
    {
        $chart = $this->createChart();

        $this->assertTrue(is_string($chart->getId()));
    }

    public function testTitle()
    {
        $chart = $this->createChart();

        $this->assertNull($chart->getTitle());
        $this->assertSame($chart, $chart->setTitle('Title'));
        $this->assertSame('Title', $chart->getTitle());
    }

    public function testSubtitle()
    {
        $chart = $this->createChart();

        $this->assertNull($chart->getSubtitle());
        $this->assertSame($chart, $chart->setSubtitle('Subtitle'));
        $this->assertSame('Subtitle', $chart->getSubtitle());
    }

    public function testXAxis()
    {
        $chart = $this->createChart();

        $this->assertEmpty($chart->getXAxes());

        $axis1 = $this->getMock('Misd\Highcharts\Axis\XAxisInterface');
        $axis2 = $this->getMock('Misd\Highcharts\Axis\XAxisInterface');

        $this->assertSame($chart, $chart->addXAxis($axis1));
        $this->assertSame($chart, $chart->addXAxis($axis2));
        $this->assertSame(array($axis1, $axis2), $chart->getXAxes());
    }

    public function testYAxis()
    {
        $chart = $this->createChart();

        $this->assertEmpty($chart->getYAxes());

        $axis1 = $this->getMock('Misd\Highcharts\Axis\YAxisInterface');
        $axis2 = $this->getMock('Misd\Highcharts\Axis\YAxisInterface');

        $this->assertSame($chart, $chart->addYAxis($axis1));
        $this->assertSame($chart, $chart->addYAxis($axis2));
        $this->assertSame(array($axis1, $axis2), $chart->getYAxes());
    }

    public function testSeries()
    {
        $chart = $this->createChart();

        $this->assertEmpty($chart->getSeries());

        $series1 = $this->getMock('Misd\Highcharts\Series\SeriesInterface');
        $series2 = $this->getMock('Misd\Highcharts\Series\SeriesInterface');

        $this->assertSame($chart, $chart->addSeries($series1));
        $this->assertSame($chart, $chart->addSeries($series2));
        $this->assertSame(array($series1, $series2), $chart->getSeries());
        $this->assertSame($chart, $chart->clearSeries());
        $this->assertEmpty($chart->getSeries());
    }

    /**
     * @expectedException \Misd\Highcharts\Exception\InvalidArgumentException
     */
    public function testSeriesInvalidArgumentExceptionOnIndividual()
    {
        $chart = $this->createChart();

        $chart->addSeries('test');
    }

    /**
     * @expectedException \Misd\Highcharts\Exception\InvalidArgumentException
     */
    public function testSeriesInvalidArgumentExceptionOnArray()
    {
        $chart = $this->createChart();

        $chart->addSeries(array($this->getMock('Misd\Highcharts\Series\SeriesInterface'), 'test'));
    }

    public function testLegend()
    {
        $chart = $this->createChart();

        $this->assertTrue($chart->hasLegend());
        $this->assertSame($chart, $chart->setLegend(false));
        $this->assertFalse($chart->hasLegend());
    }

    /**
     * @expectedException \Misd\Highcharts\Exception\InvalidArgumentException
     */
    public function testLegendInvalidArgumentException()
    {
        $chart = $this->createChart();

        $chart->setLegend(null);
    }

    public function testTooltip()
    {
        $chart = $this->createChart();

        $this->assertInstanceOf('Misd\Highcharts\Tooltip\TooltipInterface', $chart->getTooltip());
    }

    public function testCredits()
    {
        $chart = $this->createChart();

        $this->assertInstanceOf('Misd\Highcharts\Credit\CreditInterface', $chart->getCredit());
    }
}
