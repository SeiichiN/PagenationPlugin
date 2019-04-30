<?php
/*
 * @wordpress-plugin
 * Plugin Name: Billies Pagenation Plugin
 * Description: This is Pagenation for archive page, etc.
 * Version: 1.0
 * URL: 
 * Author: Seiichi Nukayama
 * URL: http://www.billies-works.com/
 */

/*
 * 使い方
 * ページネーションを使いたいところに以下のタグを記入するだけ。
 *   <?php billies_pagenation(); ?>
 *
 * ただし、WordPressのメインループの外でなければならない。
 *
 * 参考
 *   関数リファレンス/paginate links
 *     https://wpdocs.osdn.jp/%E9%96%A2%E6%95%B0%E3%83%AA%E3%83%95%E3%82%A1%E3%83%AC%E3%83%B3%E3%82%B9/paginate_links
 *
 *   コピペでOK！WordPressでページネーションを実装する【WordPressカスタマイズ
 *     https://naoyu.net/wordpress-pagination-customize/
 *
 */
function billies_pagenation_add_files() {
    wp_enqueue_style('css-billies-pagenation', plugins_url('billies-pagenation.css', __FILE__));
}
add_action('wp_enqueue_scripts', 'billies_pagenation_add_files');

function billies_pagenation() {
    global $wp_query;
    $big = 999999999;

    if ($wp_query->max_num_pages <= 1) return;

    echo '<nav class="billies-pagenation">';

    echo paginate_links (array (
        'base' => str_replace ($big, '%#%', esc_url (get_pagenum_link ($big))),
        'format' => '?paged=%#%',
        'current' => max (1, get_query_var('paged')),  // 現在のページ番号
        'total' => $wp_query->max_num_pages,  // 最大ページ番号
        'prev_text' => '<',  // '&larr;',
        'next_text' => '>',  // '&rarr;',
        'type' => 'list',
        'end_size' => 2,
        'mid_size' => 1
    ));
    echo '</nav>';

}
