/*********************************************************
 * header.js
 * ヘッダ部分のjQueryソース
 * Create: 2022/04/03(Sun)
 * Update: 2022/04/03(Sun)
 *********************************************************/

$( () => {
    /********************************************************
     * ハンバーガーメニューのclickイベントハンドラ
     ********************************************************/
    $( '#humberger-btn' ).click( () => {
        var $humberger_menu = $( '.humberger-wrapper' );

        if ( $humberger_menu.hasClass( 'active' ) )
        {
            $humberger_menu.slideUp( 'fast' );
            $humberger_menu.removeClass( 'active' );
        }
        else
        {
            $humberger_menu.slideDown( 'fast' );
            $humberger_menu.addClass( 'active' );
        }
    });
});