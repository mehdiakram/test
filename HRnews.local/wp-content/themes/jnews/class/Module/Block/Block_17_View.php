<?php
/**
 * @author : Jegtheme
 */
namespace JNews\Module\Block;

Class Block_17_View extends BlockViewAbstract
{
    public function render_block_type_1($post, $image_size)
    {
        $thumbnail          = $this->get_thumbnail($post->ID, $image_size);
        $primary_category   = $this->get_primary_category($post->ID);

        $output =
            "<article " . jnews_post_class("jeg_post jeg_pl_md_1", $post->ID) . ">
                <div class=\"jeg_thumb\">
                    " . jnews_edit_post( $post->ID ) . "
                    <a href=\"" . get_the_permalink($post) . "\">" . $thumbnail . "</a>
                    <div class=\"jeg_post_category\">
                        <span>{$primary_category}</span>
                    </div>
                </div>
                <div class=\"jeg_postblock_content\">
                    <h3 class=\"jeg_post_title\">
                        <a href=\"" . get_the_permalink($post) . "\">" . get_the_title($post) . "</a>
                    </h3>
                    " . $this->post_meta_1($post) . "
                    <div class=\"jeg_post_excerpt\">
                        <p>" . $this->get_excerpt($post) . "</p>
                    </div>
                </div>
            </article>";

        return $output;
    }

    public function render_block_type_2($post, $image_size)
    {
        $thumbnail = $this->get_thumbnail($post->ID, $image_size);
        $additional_class = (!has_post_thumbnail($post->ID)) ? ' no_thumbnail' : '';

        $output =
            "<article " . jnews_post_class("jeg_post jeg_pl_sm" . $additional_class, $post->ID) . ">
                <div class=\"jeg_thumb\">
                    " . jnews_edit_post( $post->ID ) . "
                    <a href=\"" . get_the_permalink($post) . "\">" . $thumbnail . "</a>
                </div>
                <div class=\"jeg_postblock_content\">
                    <h3 class=\"jeg_post_title\">
                        <a href=\"" . get_the_permalink($post) . "\">" . get_the_title($post) . "</a>
                    </h3>
                    " . $this->post_meta_2($post) . "
                </div>
            </article>";

        return $output;
    }

    public function build_column_1($results)
    {
        $first_block = $this->render_block_type_1($results[0], 'jnews-360x180', '');

        $second_block = '';
        for($i = 1; $i < sizeof($results); $i++) {
            $second_block .= $this->render_block_type_2($results[$i], 'jnews-120x86');
        }

        $output =
            "<div class=\"jeg_posts_wrap\">
                <div class=\"jeg_posts jeg_load_more_flag\">
                    {$first_block}
                    {$second_block}
                </div>
            </div>";

        return $output;
    }

    public function build_column_2($results)
    {
        $first_block = '';
        for($i = 0; $i < sizeof($results); $i++) {
            if ($i < 2)
            {
                $first_block .= $this->render_block_type_1($results[$i], 'jnews-750x536');
            } else {
                $first_block .= $this->render_block_type_2($results[$i], 'jnews-120x86');
            }
        }

        $output =
            "<div class=\"jeg_posts_wrap\">
                <div class=\"jeg_posts jeg_load_more_flag\">
                    {$first_block}
                </div>
            </div>";

        return $output;
    }

    public function build_column_3($results)
    {
        $first_block = '';
        for($i = 0; $i < sizeof($results); $i++) {
            if ($i < 3)
            {
                $first_block .= $this->render_block_type_1($results[$i], 'jnews-360x180');
            } else {
                $first_block .= $this->render_block_type_2($results[$i], 'jnews-120x86');
            }
        }

        $output =
            "<div class=\"jeg_posts_wrap\">
                <div class=\"jeg_posts jeg_load_more_flag\">
                    {$first_block}
                </div>
            </div>";

        return $output;
    }

    public function build_column_1_alt($results)
    {
        $first_block = '';
        for($i = 0; $i < sizeof($results); $i++) {
            $first_block .= $this->render_block_type_2($results[$i], 'jnews-120x86');
        }

        $output = $first_block;

        return $output;
    }

    public function render_output($attr, $column_class)
    {
	    if ( isset( $attr['results'] ) ) {
		    $results = $attr['results'];
	    } else {
		    $results = $this->build_query($attr);
	    }

        $navigation = $this->render_navigation($attr, $results['next'], $results['prev'], $results['total_page']);

        if(!empty($results['result'])) {
            $content = $this->render_column($results['result'], $column_class);
        } else {
            $content = $this->empty_content();
        }

        return
            "<div class=\"jeg_block_container\">
                {$this->get_content_before($attr)}
                {$content}
                {$this->get_content_after($attr)}
            </div>
            <div class=\"jeg_block_navigation\">
                {$this->get_navigation_before($attr)}
                {$navigation}
                {$this->get_navigation_after($attr)}
            </div>";
    }

    public function render_column($result, $column_class)
    {
        switch($column_class)
        {
            case "jeg_col_1o3" :
                $content = $this->build_column_1($result);
                break;
            case "jeg_col_3o3" :
                $content = $this->build_column_3($result);
                break;
            case "jeg_col_2o3" :
            default :
                $content = $this->build_column_2($result);
                break;
        }

        return $content;
    }

    public function render_column_alt($result, $column_class)
    {
        $content = $this->build_column_1_alt($result);
        return $content;
    }
}
