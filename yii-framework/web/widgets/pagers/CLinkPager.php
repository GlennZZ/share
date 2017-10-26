<?php
/**
 * CLinkPager class file.
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @link http://www.yiiframework.com/
 * @copyright 2008-2013 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

/**
 * CLinkPager displays a list of hyperlinks that lead to different pages of target.
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @package system.web.widgets.pagers
 * @since 1.0
 */
class CLinkPager extends BCLinkPager
{
	 const CSS_FIRST_PAGE = 'prev';
    const CSS_LAST_PAGE = 'next';
    const CSS_PREVIOUS_PAGE = 'prev';
    const CSS_NEXT_PAGE = 'next';
    const CSS_INTERNAL_PAGE = '';
    const CSS_HIDDEN_PAGE = 'disabled';
    const CSS_SELECTED_PAGE = 'primary-bg';

    /**
     * @var string the CSS class for the first page button. Defaults to 'first'.
     * @since 1.1.11
     */
    public $firstPageCssClass = self::CSS_FIRST_PAGE;

    /**
     * @var string the CSS class for the last page button. Defaults to 'last'.
     * @since 1.1.11
     */
    public $lastPageCssClass = self::CSS_LAST_PAGE;

    /**
     * @var string the CSS class for the previous page button. Defaults to 'previous'.
     * @since 1.1.11
     */
    public $previousPageCssClass = self::CSS_PREVIOUS_PAGE;

    /**
     * @var string the CSS class for the next page button. Defaults to 'next'.
     * @since 1.1.11
     */
    public $nextPageCssClass = self::CSS_NEXT_PAGE;

    /**
     * @var string the CSS class for the internal page buttons. Defaults to 'page'.
     * @since 1.1.11
     */
    public $internalPageCssClass = self::CSS_INTERNAL_PAGE;

    /**
     * @var string the CSS class for the hidden page buttons. Defaults to 'hidden'.
     * @since 1.1.11
     */
    public $hiddenPageCssClass = self::CSS_HIDDEN_PAGE;

    /**
     * @var string the CSS class for the selected page buttons. Defaults to 'selected'.
     * @since 1.1.11
     */
    public $selectedPageCssClass = self::CSS_SELECTED_PAGE;

    /**
     * @var integer maximum number of page buttons that can be displayed. Defaults to 10.
     */
    public $maxButtonCount = 10;

    /**
     * @var string the text label for the next page button. Defaults to 'Next &gt;'.
     */
    public $nextPageLabel = '&gt;';

    /**
     * @var string the text label for the previous page button. Defaults to '&lt; Previous'.
     */
    public $prevPageLabel = '&lt;';

    /**
     * @var string the text label for the first page button. Defaults to '&lt;&lt; First'.
     */
    public $firstPageLabel = '&lt;&lt;';

    /**
     * @var string the text label for the last page button. Defaults to 'Last &gt;&gt;'.
     */
    public $lastPageLabel = '&gt;&gt;';

    /**
     * @var string the text shown before page buttons. Defaults to 'Go to page: '.
     */
    public $header = '';

    /**
     * @var string the text shown after page buttons.
     */
    public $footer = '';

    /**
     * @var mixed the CSS file used for the widget. Defaults to null, meaning
     * using the default CSS file included together with the widget.
     * If false, no CSS file will be used. Otherwise, the specified CSS file
     * will be included when using this widget.
     */
    public $cssFile;

    /**
     * @var array HTML attributes for the pager container tag.
     */
    public $htmlOptions = array('class' => 'pagination');
    protected function createPageButton($label,$page,$class,$hidden,$selected)
    {
    	if($hidden || $selected)
    		$class.=' '.($hidden ? $this->hiddenPageCssClass : $this->selectedPageCssClass);
    	return CHtml::link($label,$this->createPageUrl($page),array('class'=>'btn '.$class.' large ui-state-default'));
    }
    
}
