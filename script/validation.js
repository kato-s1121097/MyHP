/***************************************************
 * validation.js
 * 管理画面の入力値のバリデーションを行う
 * Create: 2022/05/01(Sun)
 * Update: 2022/05/04(Wed)
 *          ・カテゴリのバリデーションを修正
 ***************************************************/

$(() => {
    
    const NUM_OF_INPUT = 6;

    function Validation()
    {
        let errors = '';
        const inputs = [ '・タイトル', '・画像', '・ダウンロードファイル名', '・リリース日', '・カテゴリ', '・説明' ];

        // 入力をチェック
        for ( i = 0; i < NUM_OF_INPUT; i++ )
        {
            let input = $( '.input' ).eq( i );

            console.log( i + ':' + input.tagName );

            // セレクトボックスは空文字ではないので特殊処理
            if ( input.attr( 'name' ) == 'category-id' )
            {
                // valが0(選択されていない)ならエラー
                console.log( 'category in\n' );
                console.log( 'val: ' + input.val() );
                if ( input.val() == '0' ) errors += inputs[i] + '<br>';
            }
            else
            {
                // 空文字ならエラー
                if ( input.val() == '' ) errors += inputs[i] + '<br>';
            }
        }

        if ( errors != '' ) errors += 'の値が不正です';

        return errors;
    }

    $( 'form' ).submit( () => {
        let errors = Validation();
        if ( errors != '')
        {
            let $error = $( '.error-message' );
            $error.html( errors );
            $error.fadeIn();

            console.log( 'error-message: ' + errors );
            return false;
        }
    });

});