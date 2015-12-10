<?php
/**
 * Created by PhpStorm.
 * User: Angga Ari Wijaya
 * Date: 6/7/14
 * Time: 9:14 AM
 */

require(__SITE_PATH . '/library/Fpdf/fpdf.php');

class Printer extends FPDF
{
    // applied singleton pattern
    private static $instance = NULL;

    private $height_cell = 7;
    private $width_cell = 20;

    private $has_header_table = true;
    private $height_header_cell = 7;

    private $numbering_width = 10;
    private $has_numbering_table = false;

    // table style
    private $flow_strip_table = false;
    private $flow_horizontal_table = false;
    private $flow_vertical_table = false;
    private $stretch_table = false;

    // table border width
    private $table_border_width = 1;

    // table fill color
    private $table_r_color = 255;
    private $table_g_color = 255;
    private $table_b_color = 255;

    private $header_r_color = 255;
    private $header_g_color = 255;
    private $header_b_color = 255;

    private $odd_r_color = 255;
    private $odd_g_color = 255;
    private $odd_b_color = 255;

    private $even_r_color = 230;
    private $even_g_color = 230;
    private $even_b_color = 230;

    //table font color
    private $font_r_color = 0;
    private $font_g_color = 0;
    private $font_b_color = 0;

    private $font_header_r_color = 0;
    private $font_header_g_color = 0;
    private $font_header_b_color = 0;

    private $font_even_r_color = 0;
    private $font_even_g_color = 0;
    private $font_even_b_color = 0;

    private $font_odd_r_color = 0;
    private $font_odd_g_color = 0;
    private $font_odd_b_color = 0;

    // table border color
    private $table_border_r_color = 0;
    private $table_border_g_color = 0;
    private $table_border_b_color = 0;

    // table description
    private $has_table_description = false;
    private $table_description_content = "Table Data Generated";
    private $table_description_sub = "Sub Description";
    private $table_description_position = "top";
    private $table_description_align = "C";


    /**
     * @return null|Printer
     * get singleton instance
     */
    public static function getInstance()
    {
        if (!self::$instance) {
            self::$instance = new Printer();
        }
        return self::$instance;
    }


    /**
     * @param bool $stretch
     */
    protected function set_stretch_table($stretch = false)
    {
        $this->stretch_table = $stretch;
    }

    /**
     * @param int $height_cell height table cell
     * @param int $width_cell width table cell
     * @param int $header_height height table header
     * @param bool $has_header is table has header
     */
    protected function set_table_size($height_cell = 7, $width_cell = 20, $header_height = 7, $has_header = true)
    {
        $this->height_cell = $height_cell;
        $this->width_cell = $width_cell;
        $this->height_header_cell = $header_height;
        $this->has_header_table = $has_header;
    }

    /**
     * @param int $stroke width border
     * @param bool $strip for zebra table
     * @param bool $horizontal for border horizontal
     * @param bool $vertical for border vertical
     */
    protected function set_table_style($stroke = 1, $strip = true, $horizontal = true, $vertical = true)
    {
        $this->table_border_width = $stroke;
        $this->flow_strip_table = $strip;
        $this->flow_horizontal_table = $horizontal;
        $this->flow_vertical_table = $vertical;
    }

    /**
     * @param bool $add_numbering is table has number column
     * @param int $numbering_width width of number column
     */
    protected function set_numbering_column($add_numbering = false, $numbering_width = 10)
    {
        $this->has_numbering_table = $add_numbering;
        $this->numbering_width = $numbering_width;
    }

    /**
     * @param bool $add_description is has a description
     * @param string $description_position position of description table
     * @param string $description content of description table
     * @param string $sub support title
     * @param string $align description text
     */
    protected function set_table_description($add_description = false, $description_position = "top", $description = "Table Data Generated", $sub = "Sub Description", $align = "C")
    {
        $this->has_table_description = $add_description;
        $this->table_description_position = $description_position;
        $this->table_description_content = $description;
        $this->table_description_sub = $sub;
        $this->table_description_align = $align;
    }

    /**
     * @param int $r red color for odd row
     * @param int $g green color for odd row
     * @param int $b blue color for odd row
     */
    protected function set_table_color($r = 0, $g = 0, $b = 0)
    {
        $this->table_r_color = $r;
        $this->table_g_color = $g;
        $this->table_b_color = $b;
    }


    /**
     * @param int $r red color for table header
     * @param int $g green color for table header
     * @param int $b blue color for table header
     */
    protected function set_table_header_color($r = 0, $g = 0, $b = 0)
    {
        $this->header_r_color = $r;
        $this->header_g_color = $g;
        $this->header_b_color = $b;
    }

    /**
     * @param int $r red color for odd row
     * @param int $g green color for odd row
     * @param int $b blue color for odd row
     */
    protected function set_table_odd_color($r = 0, $g = 0, $b = 0)
    {
        $this->odd_r_color = $r;
        $this->odd_g_color = $g;
        $this->odd_b_color = $b;
    }

    /**
     * @param int $r for even row
     * @param int $g for even row
     * @param int $b for even row
     */
    protected function set_table_even_color($r = 255, $g = 255, $b = 255)
    {
        $this->even_r_color = $r;
        $this->even_g_color = $g;
        $this->even_b_color = $b;
    }

    /**
     * @param int $r red font color
     * @param int $g green font color
     * @param int $b blue font color
     */
    protected function set_table_font_color($r = 0, $g = 0, $b = 0)
    {
        $this->font_r_color = $r;
        $this->font_g_color = $g;
        $this->font_b_color = $b;
    }

    /**
     * @param int $r red font header color
     * @param int $g green font header color
     * @param int $b blue font header color
     */
    protected function set_table_font_header_color($r = 0, $g = 0, $b = 0)
    {
        $this->font_header_r_color = $r;
        $this->font_header_g_color = $g;
        $this->font_header_b_color = $b;
    }

    /**
     * @param int $r red font even color
     * @param int $g green font even color
     * @param int $b blue font even color
     */
    protected function set_table_font_even_color($r = 0, $g = 0, $b = 0)
    {
        $this->font_even_r_color = $r;
        $this->font_even_g_color = $g;
        $this->font_even_b_color = $b;
    }

    /**
     * @param int $r red font odd color
     * @param int $g green font odd color
     * @param int $b blue font odd color
     */
    protected function set_table_font_odd_color($r = 0, $g = 0, $b = 0)
    {
        $this->font_odd_r_color = $r;
        $this->font_odd_g_color = $g;
        $this->font_odd_b_color = $b;
    }


    /**
     * @param int $r red border color
     * @param int $g green border color
     * @param int $b blue border color
     */
    protected function set_table_border_color($r = 0, $g = 0, $b = 0)
    {
        $this->table_border_r_color = $r;
        $this->table_border_g_color = $g;
        $this->table_border_b_color = $b;
    }


    /**
     * @param string $orientation
     * @param string $size
     * @param int $left_margin
     * @param int $top_margin
     * @param string $title
     * @param string $author
     */
    protected function init($orientation = "L", $size = "A4", $left_margin = 20, $top_margin = 20, $title = "PDF Report", $author = "Angga Ari Wijaya")
    {
        $this->SetTitle($title);
        $this->SetAuthor($author);
        $this->SetMargins($left_margin, $top_margin);
        $this->AddPage($orientation, $size);
        $this->SetFont('Arial', '', 12);
        $this->AliasNbPages();
    }


    /**
     * @param array $header
     * @param array $data
     * @param array $width
     * @param array $header_align
     * @param array $data_align
     */
    protected function create_table($header = array(), $data = array(), $width = array(), $header_align = array(), $data_align = array())
    {
        if (sizeof($data) == 0) {
            $empty = true;
        } else {
            $empty = false;
        }

        // style table
        $this->SetDrawColor($this->table_border_r_color, $this->table_border_g_color, $this->table_border_b_color);
        $this->SetLineWidth($this->table_border_width);
        $this->SetFont('Arial', 'B', 12);

        // check if border style selected
        $border_flow = "";
        if ($this->flow_horizontal_table) {
            $border_flow .= "TB";
        }
        if ($this->flow_vertical_table) {
            $border_flow .= "LR";
        }

        // check if table is stretch then calculate distribute space
        if ($this->stretch_table) {
            if ($this->CurOrientation == "P") {
                $write_area = $this->CurPageSize[0] - ($this->lMargin + $this->rMargin);
            } else {
                $write_area = $this->CurPageSize[1] - ($this->lMargin + $this->rMargin);
            }


            if ($this->has_numbering_table) {
                $write_area -= $this->numbering_width;
            }

            $distribute_horizontal_space = $write_area / sizeof($header);

            for ($i = 0; $i < sizeof($header); $i++) {
                $width[$i] = $distribute_horizontal_space;
            }
        }

        // check if table has numbering row then add width of description with number column width
        if ($this->has_numbering_table) {
            $description_width = array_sum($width) + $this->numbering_width;
        } else {
            $description_width = array_sum($width);
        }

        // check if table has description and position in top
        if ($this->has_table_description && $this->table_description_position == "top") {
            $this->SetFont('Arial', 'B', 12);
            $this->SetTextColor(0, 0, 0);
            $this->Cell($description_width, 7, $this->table_description_content, 0, 1, $this->table_description_align);
            $this->SetFont('Arial', '', 10);
            $this->SetTextColor(100, 100, 100);
            $this->Cell($description_width, 5, $this->table_description_sub, 0, 1, $this->table_description_align);
            $this->Ln(3);
        }


        // check if table has table header
        if ($this->has_header_table) {
            $this->SetFont('Arial', 'B', 10);
            if ($border_flow == "LR") {
                $border_flow .= "TB";
            }

            // header style
            $this->SetFillColor($this->header_r_color, $this->header_g_color, $this->header_b_color);
            $this->SetTextColor($this->font_header_r_color, $this->font_header_g_color, $this->font_header_b_color);

            // create table header
            for ($i = 0; $i < count($header); $i++) {
                // check if table has numbering column
                if ($this->has_numbering_table) {
                    // add first column numbering cell
                    if ($i == 0) {
                        $this->Cell($this->numbering_width, $this->height_header_cell, "No", $border_flow, 0, "C", true);
                    }
                }

                // check if last cell then make next row in new line
                if ($i == sizeof($header) - 1) {
                    $this->Cell($width[$i], $this->height_header_cell, $header[$i], $border_flow, 1, $header_align[$i], true);
                } else {
                    $this->Cell($width[$i], $this->height_header_cell, $header[$i], $border_flow, 0, $header_align[$i], true);
                }
            }
            if ($border_flow == "LRTB") {
                $border_flow = "LR";
            }
        }

        if (!$empty) {
            // general text and fill color
            $this->SetFillColor($this->table_r_color, $this->table_g_color, $this->table_b_color);
            $this->SetTextColor($this->font_r_color, $this->font_g_color, $this->font_b_color);

            // count for numbering and table zebra
            $count = 1;
            $this->SetFont('Arial', '', 10);

            // create table data
            foreach ($data as $row) {

                // check if table is strip
                if ($this->flow_strip_table) {
                    // check row position
                    if ($count % 2 == 0) {
                        // even
                        $this->SetFillColor($this->even_r_color, $this->even_g_color, $this->even_b_color);
                        $this->SetTextColor($this->font_even_r_color, $this->font_even_g_color, $this->font_even_b_color);
                    } else {
                        // odd
                        $this->SetFillColor($this->odd_r_color, $this->odd_g_color, $this->odd_b_color);
                        $this->SetTextColor($this->font_odd_r_color, $this->font_odd_g_color, $this->font_odd_b_color);
                    }
                }

                // create table row
                for ($i = 0; $i < sizeof($width); $i++) {

                    // check if table has numbering column then add numbering row in first cell
                    if ($this->has_numbering_table) {
                        if ($i == 0) {
                            $this->Cell($this->numbering_width, $this->height_cell, $count, $border_flow, 0, 'C', $this->flow_strip_table);
                        }
                    }

                    // check if last cell then next row in new line
                    if ($i == sizeof($width) - 1) {
                        $this->Cell($width[$i], $this->height_cell, $row[$i], $border_flow, 1, $data_align[$i], $this->flow_strip_table);
                    } else {
                        $this->Cell($width[$i], $this->height_cell, $row[$i], $border_flow, 0, $data_align[$i], $this->flow_strip_table);
                    }
                }

                // increment counter row
                $count++;
            }
        } else {
            $this->SetFillColor(240, 240, 240);
            $this->Cell($description_width, 10, "No data available in table", 0, 1, "C", true);
        }

        // check border flow horizontal for closing
        if ($border_flow == "LR") {
            if ($this->has_numbering_table) {
                $this->Cell(array_sum($width) + $this->numbering_width, 0, '', 'T');
            } else {
                $this->Cell(array_sum($width), 0, '', 'T');
            }
        }

        // check if table has description and position in bottom
        if ($this->has_table_description && $this->table_description_position == "bottom") {
            $this->Ln(3);
            $this->SetTextColor(0, 0, 0);
            $this->SetFont('Arial', 'B', 12);
            $this->Cell($description_width, 7, $this->table_description_content, 0, 1, $this->table_description_align);
            $this->SetTextColor(100, 100, 100);
            $this->SetFont('Arial', '', 10);
            $this->Cell($description_width, 5, $this->table_description_sub, 0, 1, $this->table_description_align);
        }

        // add some space
        $this->Ln(3);
        $this->SetFillColor(0);
        $this->SetTextColor(0);
    }


}