<?php

declare(strict_types=1);

namespace ResourceTotals\Site\BlockLayout;

use Laminas\Form\Element;
use Laminas\Form\Form;
use Laminas\View\Renderer\PhpRenderer;
use Omeka\Api\Representation\SitePageBlockRepresentation;
use Omeka\Api\Representation\SitePageRepresentation;
use Omeka\Api\Representation\SiteRepresentation;
use Omeka\Entity\SitePageBlock;
use Omeka\Site\BlockLayout\AbstractBlockLayout;
use Omeka\Stdlib\ErrorStore;
use Omeka\Stdlib\HtmlPurifier;

class ResourceTotals extends AbstractBlockLayout
{
    /**
     * @var HtmlPurifier
     */
    protected $htmlPurifier;

    public function __construct(HtmlPurifier $htmlPurifier)
    {
        $this->htmlPurifier = $htmlPurifier;
    }

    public function getLabel()
    {
        return 'Resource totals'; // @translate
    }

    public function onHydrate(SitePageBlock $block, ErrorStore $errorStore)
    {
        $data = $block->getData();
        $data['html'] = isset($data['html'])
            ? $this->htmlPurifier->purify($data['html'])
            : '';
        $data['divclass'] = isset($data['divclass'])
            ? trim($data['divclass'])
            : '';
        $block->setData($data);
    }

    public function form(
        PhpRenderer $view,
        SiteRepresentation $site,
        ?SitePageRepresentation $page = null,
        ?SitePageBlockRepresentation $block = null
    ) {
        $defaults = [
            'html' => '<p>Items: <strong>{item_total}</strong><br>Media: <strong>{media_total}</strong></p>',
            'divclass' => '',
        ];
        $data = $block ? $block->data() + $defaults : $defaults;

        $form = new Form();
        $html = new Element\Textarea("o:block[__blockIndex__][o:data][html]");
        $html->setOptions([
            'label' => 'Markup text', // @translate
            'info' => 'Available variables: {item_total}, {media_total}, {item_total_raw}, {media_total_raw}. Variables may also use double braces, for example {{ item_total }}.', // @translate
        ]);
        $html->setAttributes([
            'class' => 'block-html full wysiwyg',
        ]);
        $html->setValue($data['html']);

        $divClass = new Element\Text("o:block[__blockIndex__][o:data][divclass]");
        $divClass->setOptions([
            'label' => 'Class', // @translate
            'info' => 'Optional CSS class for styling the block wrapper.', // @translate
        ]);
        $divClass->setValue($data['divclass']);

        $form->add($html);
        $form->add($divClass);

        return $view->formCollection($form);
    }

    public function render(PhpRenderer $view, SitePageBlockRepresentation $block)
    {
        $html = $block->dataValue('html', '');
        $itemTotal = $this->getTotalResults($view, 'items');
        $mediaTotal = $this->getTotalResults($view, 'media');

        $html = $this->replaceVariables($html, [
            'item_total' => number_format($itemTotal),
            'items_total' => number_format($itemTotal),
            'item_count' => number_format($itemTotal),
            'media_total' => number_format($mediaTotal),
            'media_count' => number_format($mediaTotal),
            'item_total_raw' => (string) $itemTotal,
            'items_total_raw' => (string) $itemTotal,
            'item_count_raw' => (string) $itemTotal,
            'media_total_raw' => (string) $mediaTotal,
            'media_count_raw' => (string) $mediaTotal,
        ]);

        $divClass = $view->escapeHtml($block->dataValue('divclass'));
        if ('' !== $divClass) {
            $html = sprintf('<div class="%s">%s</div>', $divClass, $html);
        }

        return $html;
    }

    public function getFulltextText(PhpRenderer $view, SitePageBlockRepresentation $block)
    {
        return strip_tags($this->render($view, $block));
    }

    protected function getTotalResults(PhpRenderer $view, string $resourceName): int
    {
        $response = $view->api()->search($resourceName, ['limit' => 0]);
        return (int) $response->getTotalResults();
    }

    protected function replaceVariables(string $markup, array $variables): string
    {
        return preg_replace_callback(
            '/\{\{\s*([a-z_]+)\s*\}\}|\{([a-z_]+)\}/',
            function (array $matches) use ($variables): string {
                $key = isset($matches[1]) && '' !== $matches[1]
                    ? $matches[1]
                    : $matches[2];
                return array_key_exists($key, $variables)
                    ? $variables[$key]
                    : $matches[0];
            },
            $markup
        );
    }
}
