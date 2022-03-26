<?php

?>
<div id="{{data.id}}" class="wpal_ecomm_modal micromodal-slide" aria-hidden="true">
    <div class="wpal_ecomm_modal__overlay" tabindex="-1" data-micromodal-close>
        <div class="wpal_ecomm_modal__container" role="dialog" aria-modal="true" aria-labelledby="{{data.id}}-title" >
            <header class="wpal_ecomm_modal__header">
                <h2 id="{{data.id}}-title" class="wpal_ecomm_modal__title wpal-ecomm-main_color">
                    {{{data.title}}}
                </h2>
                <button class="wpal_ecomm_modal__close"
                        aria-label="<?php echo __('Close notificaton', 'wpal_ecomm');?>"
                        data-micromodal-close>
                </button>
            </header>
            <main class="wpal_ecomm_modal__content" id="{{data.id}}-content">
                {{{data.content}}}
            </main>
            <# if( data.footer > '' ){ #>
            <footer class="wpal_ecomm_modal__footer">
                {{{data.footer}}}
            </footer>
            <# } #>
        </div>
    </div>
</div>
