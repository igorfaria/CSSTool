<?php

namespace CSSTool;

class Optimizer
{
    private $prop_prefixes = [];

    public function __construct(){
        
        $this->set_webkit_prefixes();
        $this->set_moz_prefixes();
        $this->set_o_prefixes();
        $this->set_ms_prefixes();
        $this->set_epub_prefixes();

    }

    static function from_parsed($parsedCSS){
        
        if(!is_array($parsedCSS)) return $parsedCSS;

        $responseCSS = [];
        $selfInstance = new self;
        
        foreach($parsedCSS as $key=>$value){
           var_dump($value);
        }
        
        die("LALALA");
    }

    public function set_webkit_prefixes(){
        $this->prop_prefixes['-webkit-'] = [
            'align-content','align-items','align-self','animation','animation-delay',
            'animation-direction','animation-duration','animation-fill-mode','animation-iteration-count',
            'animation-name','animation-play-state','animation-timing-function','app-region',
            'appearance','aspect-ratio','backface-visibility','background-clip','background-composite',
            'background-origin','background-size','border-after','border-after-color','border-after-style',
            'border-after-width','border-before','border-before-color','border-before-style',
            'border-before-width','border-bottom-left-radius','border-bottom-right-radius',
            'border-end','border-end-color','border-end-style','border-end-width','border-fit',
            'border-horizontal-spacing','border-image','border-radius','border-start','border-start-color',
            'border-start-style','border-start-width','border-top-left-radius','border-top-right-radius',
            'border-vertical-spacing','box-align','box-decoration-break','box-direction','box-flex',
            'box-flex-group','box-lines','box-ordinal-group','box-orient','box-pack','box-reflect',
            'box-shadow','box-sizing','clip-path','column-break-after','column-break-before',
            'column-break-inside','column-count','column-gap','column-rule','column-rule-color',
            'column-rule-style','column-rule-width','column-span','column-width','columns','filter',
            'flex','flex-basis','flex-direction','flex-flow','flex-grow','flex-shrink','flex-wrap',
            'font-feature-settings','font-size-delta','font-smoothing','highlight','hyphenate-character',
            'justify-content','line-box-contain','line-break','line-clamp','locale','logical-height',
            'logical-width','margin-after','margin-after-collapse','margin-before','margin-before-collapse',
            'margin-bottom-collapse','margin-collapse','margin-end','margin-start','margin-top-collapse',
            'mask','mask-box-image','mask-box-image-outset','mask-box-image-repeat','mask-box-image-slice',
            'mask-box-image-source','mask-box-image-width','mask-clip','mask-composite','mask-image',
            'mask-origin','mask-position','mask-position-x','mask-position-y','mask-repeat','mask-repeat-x',
            'mask-repeat-y','mask-size','max-logical-height','max-logical-width','min-logical-height',
            'min-logical-width','opacity','order','padding-after','padding-before','padding-end','padding-start',
            'perspective','perspective-origin','perspective-origin-x','perspective-origin-y','print-color-adjust',
            'rtl-ordering','ruby-position','shape-image-threshold','shape-margin','shape-outside',
            'tap-highlight-color','text-combine','text-decorations-in-effect','text-emphasis','text-emphasis-color',
            'text-emphasis-position','text-emphasis-style','text-fill-color','text-orientation','text-security',
            'text-size-adjust','text-stroke','text-stroke-color','text-stroke-width','transform','transform-origin',
            'transform-origin-x','transform-origin-y','transform-origin-z','transform-style','transition',
            'transition-delay','transition-duration','transition-property','transition-timing-function',
            'user-drag','user-modify','user-select','writing-mode'
        ];

        return $this->prop_prefixes;
    }

    public function set_moz_prefixes(){
        $this->prop_prefixes['-moz-'] = [
            'appearance','binding','border-bottom-colors','border-end','border-end-color','border-end-style',
            'border-end-width','border-left-colors','border-right-colors','border-start','border-start-color',
            'border-start-style','border-start-width','border-top-colors','box-align','box-direction',
            'box-flex','box-ordinal-group','box-orient','box-pack','column-count','column-fill','column-gap',
            'column-rule','column-rule-color','column-rule-style','column-rule-width','column-width','columns',
            'control-character-visibility','float-edge','force-broken-image-icon','hyphens','image-region',
            'margin-end','margin-start','math-display','math-variant','min-font-size-ratio','orient',
            'osx-font-smoothing','outline-radius','outline-radius-bottomleft','outline-radius-bottomright',
            'outline-radius-topleft','outline-radius-topright','padding-end','padding-start','script-level',
            'script-min-size','script-size-multiplier','stack-sizing','tab-size','text-align-last',
            'text-decoration-color','text-decoration-line','text-decoration-style','text-size-adjust',
            'top-layer','transform','user-focus','user-input','user-modify','user-select','window-dragging','window-shadow'
        ];
        return $this->prop_prefixes;
    }

    public function set_ms_prefixes(){
        $this->prop_prefixes['-ms-'] = [
           'accelerator','animation','animation-delay','animation-direction','animation-duration',
           'animation-fill-mode','animation-iteration-count','animation-name','animation-play-state',
           'animation-timing-function','backface-visibility','background-position-x','background-position-y',
           'behavior','block-progression','content-zoom-chaining','content-zoom-limit','content-zoom-limit-max',
           'content-zoom-limit-min','content-zoom-snap','content-zoom-snap-points','content-zoom-snap-type',
           'content-zooming','filter','flex','flex-align','flex-direction','flex-flow','flex-item-align',
           'flex-line-pack','flex-negative','flex-order','flex-pack','flex-positive','flex-preferred-size',
           'flex-wrap','flow-from','flow-into','font-feature-settings','grid-column','grid-column-align',
           'grid-column-span','grid-columns','grid-row','grid-row-align','grid-row-span','grid-rows',
           'high-contrast-adjust','hyphenate-limit-chars','hyphenate-limit-lines','hyphenate-limit-zone','hyphens',
           'ime-align','ime-mode','interpolation-mode','layout-flow','layout-grid','layout-grid-char',
           'layout-grid-line','layout-grid-mode','layout-grid-type','line-break','overflow-style','overflow-x',
           'overflow-y','perspective','perspective-origin','perspective-origin-x','perspective-origin-y',
           'scroll-chaining','scroll-limit','scroll-limit-x-max','scroll-limit-x-min','scroll-limit-y-max',
           'scroll-limit-y-min','scroll-rails','scroll-snap-points-x','scroll-snap-points-y','scroll-snap-type',
           'scroll-snap-x','scroll-snap-y','scroll-translation','scrollbar-3dlight-color','scrollbar-arrow-color',
           'scrollbar-base-color','scrollbar-darkshadow-color','scrollbar-face-color','scrollbar-highlight-color',
           'scrollbar-shadow-color','scrollbar-track-color','text-align-last','text-autospace','text-combine-horizontal',
           'text-justify','text-kashida-space','text-overflow','text-size-adjust','text-underline-position',
           'touch-action','touch-select','transform','transform-origin','transform-origin-x','transform-origin-y',
           'transform-origin-z','transform-style','transition','transition-delay','transition-duration',
           'transition-property','transition-timing-function','user-select','word-break','word-wrap','wrap-flow',
           'wrap-margin','wrap-through','writing-mode','zoom'
        ];
        return $this->prop_prefixes;
    }

    public function set_o_prefixes(){
        $this->prop_prefixes['-o-'] = [
            'object-fit'
        ];
        return $this->prop_prefixes;
    }

    public function set_epub_prefixes(){
        $this->prop_prefixes['-epub-'] = [
            'caption-side','text-combine','text-emphasis','text-emphasis-color','text-emphasis-style',
            'text-orientation','text-transform','word-break','writing-mode',
        ];
        return $this->prop_prefixes;
    }
            
}