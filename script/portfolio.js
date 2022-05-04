/*********************************************************************************
 * portfolio.js
 * ポートフォリオのイベントハンドラを実装する
 * Create: 2022/04/10(Sun)
 * Update: 2022/04/10(Sun)
 */

$( () => {

    var current_filter = 0x0F;
    const WIN_BIT = 0x01;
    const WEB_BIT = 0x02;
    const IAPP_BIT = 0x04;
    const VBA_BIT = 0x08;
    const filters = [ 0, WIN_BIT, WEB_BIT, IAPP_BIT, VBA_BIT ];
    const MAX_CATEGORY = 4;

    /***************************************************************
     * Function: SetBackgroundColor
     * Description: $targetに指定したフィルタオブジェクトに現在の状態に応じた背景色を付ける
     * Params: $target = 背景色をセットするフィルタオブジェクト
     *         filter_bit = フィルタオブジェクトに対応するビット
     ****************************************************************/
    function SetBackgroundColor( $target, filter_bit )
    {
        var background_color = current_filter & filter_bit ? '#000000' : '#cccccc';
        $target.css( 'background-color', background_color );
    }

    $( '.filter-btn').click( () => {
        $( '.filter-wrapper' ).fadeIn();
    });

    /**************************************************
     * フィルタのクリックイベントをまとめる案
     * idの取得がうまくいかないためオミット

    $( '.filter' ).click( () => {
        var id = $( this ).attr( 'id' );
        console.log( $( this ).attr( 'id' ) );
        console.log( id );
        var filter_bit;
        if ( id == 'win-filter' ) filter_bit = WIN_BIT;
        else if ( id == 'web-filter' ) filter_bit = WEB_BIT;
        else if ( id == 'iapp-filter' ) filter_bit = IAPP_BIT;
        else if ( id == 'vba-filter' ) filter_bit = VBA_BIT;
        
        current_filter ^= filter_bit;
        SetBackgroundColor( $( this ), filter_bit );
    });
    */

    $( '#win-filter' ).click( () => {
        current_filter ^= WIN_BIT;
        SetBackgroundColor( $( '#win-filter' ), WIN_BIT );
    });

    $( '#web-filter' ).click( () => {
        current_filter ^= WEB_BIT;
        SetBackgroundColor( $( '#web-filter' ), WEB_BIT );
    });

    $( '#iapp-filter' ).click( () => {
        current_filter ^= IAPP_BIT;
        SetBackgroundColor( $( '#iapp-filter' ), IAPP_BIT );
    });

    $( '#vba-filter' ).click( () => {
        current_filter ^= VBA_BIT;
        SetBackgroundColor( $( '#vba-filter' ), VBA_BIT );
    });

    $( '#decide-filter' ).click( () => {
        for ( i = 1; i <= MAX_CATEGORY; i++ )
        {
            var display = current_filter & filters[i] ? 'block' : 'none';
            $( '.category' + i ).css( 'display', display );
        }

        $( '.filter-wrapper' ).fadeOut();
    });

});