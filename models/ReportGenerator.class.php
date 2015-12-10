<?php

/**
 * Created by PhpStorm.
 * User: Angga Ari Wijaya
 * Date: 6/7/14
 * Time: 5:26 PM
 */
class ReportGenerator extends Printer
{
    // applied singleton pattern
    private static $instance = NULL;

    private $player;

    /**
     * @return null|Printer|ReportGenerator
     * get singleton instance
     */
    public static function getInstance()
    {
        if (!self::$instance) {
            self::$instance = new ReportGenerator();
        }
        return self::$instance;
    }

    /**
     * override Header function
     */
    public function Header()
    {
        if ($this->CurOrientation == "P") {
            $this->Image(__SITE_PATH . '/assets/images/layout/report-background.jpg', 0, 0, $this->CurPageSize[0]);
            $this->Image(__SITE_PATH . '/assets/images/layout/report-background-inverted.jpg', 0, 200, $this->CurPageSize[0]);
        } else {
            $this->Image(__SITE_PATH . '/assets/images/layout/report-background.jpg', 0, 0, $this->CurPageSize[1]);
        }

        // Logo
        $this->Image(__SITE_PATH . '/assets/images/layout/logo-dark.png', 20, 20, 55);
        // Arial bold 15
        $this->SetFont('Arial', '', 13);

        // Title
        $this->SetX(-100);
        $this->Cell(80, 7, 'Business Career The Game', 0, 2, 'R');
        $this->SetFont('Arial', '', 10);
        $this->SetTextColor(150, 150, 150);
        $this->Cell(80, 5, 'Accounting Learning and Training', 0, 2, 'R');
        $this->SetFont('Arial', '', 8);

        $this->Ln(4);

        $this->SetX(20);
        $this->Cell(80, 4, 'Address : Java Street 6 No. 5', 0, 0, 'L');

        $this->SetX(-100);
        $this->Cell(80, 4, 'Contact : +6285655479868', 0, 1, 'R');

        $this->SetX(20);
        $this->Cell(80, 4, 'Website : http://www.businesscareerthegame.com', 0, 0, 'L');

        $this->SetX(-100);
        $this->Cell(80, 4, 'Email : businesscareer@seriousgame.com', 0, 0, 'R');

        // Line break
        $this->Ln(12);

    }

    /**
     * override Footer function
     */
    public function Footer()
    {
        // Position at 1.5 cm from bottom
        $this->SetFont('Arial', 'B', 11);
        $this->SetY(-25);
        $this->Cell(80, 5, 'Accounting Learning and Training', 0, 0, 'L');
        $this->SetFont('Arial', 'B', 8);
        $this->SetX(-50);
        // Page number
        $this->SetTextColor(100, 100, 100);
        $this->Cell(30, 5, 'Report Page ' . $this->PageNo() . '/{nb}', 0, 1, 'R');
        $this->Cell(125, 6, 'Copyright 2014 Business Career, made with Love and Actionscript 3.0', 0, 1, 'L');
    }

    public function get_report_player_detail($data)
    {
        $this->player = $data;

        $this->init("P", "A4", 20, 20, "Player Detail Report", "SeriousGame.Inc");

        // width, height, text, border{1,0}, next{0,1,2}, align{'L','C','R'}
        $this->SetFont('Arial', 'B', 14);
        $this->Cell(70, 7, 'Player Achievement Report', 0, 1, 'L');
        $this->SetTextColor(100, 100, 100);
        $this->SetFont('Arial', '', 9);
        $this->Cell(40, 5, "Generated at " . date('d/m/Y'), 0, 0);


        $this->SetX(-60);
        $this->Cell(40, 5, "Report ID " . uniqid(), 0, 1);
        $this->Ln(5);

        // REPORT DESCRIPTION
        $this->SetFont('Arial', '', 12);
        $this->MultiCell(0, 7, 'SeriousGame.Inc provide best practice learning and training game, Business Career The Game is product which give player excellent experience with financial transaction. "' . strtoupper($this->player['ply_name']) . '", you have done some goal and training process through our Serious Game, below is list of transaction and your achievement.', 0, 'J');
        $this->Ln(10);

        // REPORT AVATAR PLAYER
        $this->Image(__SITE_PATH . '/assets/images/avatar/' . $this->player['ply_avatar'], 22, 107, 35, 35, '', "http://localhost/businesscareer/player/detail/" . $this->player["ply_id"]);


        // REPORT AVATAR INFORMATION
        $this->SetLeftMargin(65);
        $this->SetFont('Arial', '', 10);
        $this->Cell(40, 5, "Player Information", 0, 1);
        $this->SetFont('Arial', 'B', 12);

        $this->SetTextColor(0, 0, 0);
        $this->Cell(40, 7, "Email", 0, 0);
        $this->SetTextColor(105, 142, 43);
        $this->Cell(40, 7, $this->player['ply_email'], 0, 1);

        $this->SetTextColor(0, 0, 0);
        $this->Cell(40, 7, "Name", 0, 0);
        $this->SetTextColor(105, 142, 43);
        $this->Cell(40, 7, $this->player['ply_name'], 0, 1);

        $this->SetTextColor(0, 0, 0);
        $this->Cell(40, 7, "Balance", 0, 0);
        $this->SetTextColor(105, 142, 43);
        $this->Cell(40, 7, "IDR " . Utility::format_currency($this->player['ply_cash']), 0, 1);

        $this->SetTextColor(0, 0, 0);
        $this->Cell(40, 7, "Rating", 0, 0);
        for ($i = 0; $i < $this->player['ply_star']; $i++) {
            $this->Image(__SITE_PATH . '/assets/images/layout/star.png', ($i * 6) + 105, 134, 5);
        }
        $this->SetLeftMargin(20);
        $this->Ln(20);


        $width = array(40, 40);
        $header = array('Data', 'Capital');
        $header_align = array("L", "L");
        $data_align = array("L", "L");
        $data = array(
            array("Assets", "IDR 20000"),
            array("Revenue", "IDR 2000"),
            array("Equity", "IDR 20000"),
            array("Payable", "IDR 2000"),
            array("Receivable", "IDR 20000")
        );

        $this->set_numbering_column(true, 15);
        $this->set_table_description(true, "top", "Player Achievement", "Serious Game - Accounting Business", "C");
        $this->set_table_size(10, 20, 10, true);
        $this->set_table_style(1, true, false, false);
        $this->set_stretch_table(true);


        $this->set_table_header_color(230, 253, 193);

        $this->set_table_odd_color(255, 255, 255);
        $this->set_table_even_color(238, 253, 217);

        $this->create_table($header, $data, $width, $header_align, $data_align);


        $this->SetTextColor(100, 100, 100);
        $this->Ln(10);
        $this->SetFont('Arial', '', 10);
        $this->Cell(0, 5, "Super Admin", 0, 1, "R");
        $this->Ln(3);
        $this->SetFont('Arial', 'B', 11);
        $this->SetTextColor(50, 50, 50);
        $this->Cell(0, 5, $_SESSION["web_name"], 0, 0, "R");
    }

    /**
     * @param $data
     */
    public function get_report_player_log($data)
    {
        $this->player = $data;

        $this->init("L", "A4", 20, 20, "Player Detail Report", "SeriousGame.Inc");
        $this->SetAutoPageBreak(true, 30);

        $this->SetFont('Arial', 'B', 14);
        $this->Cell(70, 7, 'Player Logging Records', 0, 1, 'L');
        $this->SetTextColor(100, 100, 100);
        $this->SetFont('Arial', '', 9);
        $this->Cell(40, 5, "Generated at " . date('d/m/Y'), 0, 0);

        $this->SetX(-60);
        $this->Cell(40, 5, "Report ID " . uniqid(), 0, 1);
        $this->Ln(5);

        $width = array(20, 20, 20);
        $header = array('ID', 'Timestamp', 'Module', 'Operation', 'Value');
        $header_align = array("C", "C", "C", "C", "C");
        $data_align = array("C", "C", "C", "C", "C");

        $this->set_table_description(true, "top", "Player Hall of Fame Statistic", "Serious Game - Accounting Business", "L");
        $this->set_table_size(10, 20, 10, true);
        $this->set_table_style(0.3, false, true, false);
        $this->set_stretch_table(true);

        $this->set_table_border_color(200, 200, 200);

        //$this->set_table_header_color(255,255,255);

        //$this->set_table_odd_color(238,253,217);
        //$this->set_table_even_color(255,255,255);

        $this->create_table($header, $this->player, $width, $header_align, $data_align);

        $this->SetTextColor(100, 100, 100);
        $this->Ln(10);
        $this->SetFont('Arial', '', 10);
        $this->Cell(0, 5, "Super Admin", 0, 1, "R");
        $this->Ln(3);
        $this->SetFont('Arial', 'B', 11);
        $this->SetTextColor(50, 50, 50);
        $this->Cell(0, 5, $_SESSION["web_name"], 0, 0, "R");
    }


    /**
     * @param $data
     */
    public function get_report_top_10($data)
    {
        $this->player = array();

        for ($i = 0; $i < sizeof($data); $i++) {
            array_push($this->player, array($data[$i]["ply_name"], $data[$i]["ply_point"] . " PTS", "IDR " . Utility::format_currency($data[$i]["ply_cash"])));
        }

        $this->init("P", "A4", 20, 20, "Player Detail Report", "SeriousGame.Inc");
        $this->SetAutoPageBreak(true, 30);

        $this->SetFont('Arial', 'B', 14);
        $this->Cell(70, 7, 'Player Logging Report', 0, 1, 'L');
        $this->SetTextColor(100, 100, 100);
        $this->SetFont('Arial', '', 9);
        $this->Cell(40, 5, "Generated at " . date('d/m/Y'), 0, 0);


        $this->SetX(-60);
        $this->Cell(40, 5, "Report ID " . uniqid(), 0, 1);
        $this->Ln(15);

        $width = array(20, 20, 20);
        $header = array('Player', 'Game Point', 'Game Assets');
        $header_align = array("R", "C", "C");
        $data_align = array("R", "C", "C");

        $this->set_table_description(true, "top", "Player Hall of Fame Statistic", "Serious Game - Accounting Business", "C");
        $this->set_table_size(10, 20, 10, true);
        $this->set_table_style(0.3, false, true, false);
        $this->set_stretch_table(true);
        $this->set_numbering_column(true, 10);

        $this->set_table_border_color(200, 200, 200);

        //$this->set_table_header_color(255,255,255);

        //$this->set_table_odd_color(255,255,255);
        //$this->set_table_even_color(240,240,240);

        $this->create_table($header, $this->player, $width, $header_align, $data_align);

        $this->SetTextColor(100, 100, 100);
        $this->Ln(10);
        $this->SetFont('Arial', '', 10);
        $this->Cell(0, 5, "Super Admin", 0, 1, "R");
        $this->Ln(3);
        $this->SetFont('Arial', 'B', 11);
        $this->SetTextColor(50, 50, 50);
        $this->Cell(0, 5, $_SESSION["web_name"], 0, 0, "R");
    }


    /**
     * @param $data_player
     * @param $data_feedback
     * @param $data_traffic
     * @param $leaderboard
     */
    public function get_report_overall($data_player, $data_feedback, $data_traffic, $leaderboard)
    {
        $this->init("P", "A4", 20, 20, "Player Detail Report", "SeriousGame.Inc");
        $this->SetAutoPageBreak(true, 30);

        $this->SetFont('Arial', 'B', 14);
        $this->Cell(70, 7, 'Report Overall', 0, 1, 'L');
        $this->SetTextColor(100, 100, 100);
        $this->SetFont('Arial', '', 9);
        $this->Cell(40, 5, "Generated at " . date('d/m/Y'), 0, 0);


        $this->SetX(-60);
        $this->Cell(40, 5, "Report ID " . uniqid(), 0, 1);
        $this->Ln(10);


        // PLAYER REPORT
        $this->SetTextColor(50, 50, 50);
        $this->SetFont('Arial', 'B', 18);
        $this->Cell(70, 7, 'PLAYER', 0, 1, 'L');
        $this->Ln(2);

        $width = array(10, 130, 30);
        $header = array('', 'PLAYER STATUS', 'TOTAL');
        $header_align = array("C", "L", "R");
        $data_align = array("C", "L", "R");
        $player = array(
            array("", "Player Registered", (isset($data_player)) ? $data_player["total_player"] : "0"),
            array("", "Player Pending", (isset($data_player)) ? $data_player["player_pending"] : "0"),
            array("", "Player Suspended", (isset($data_player)) ? $data_player["player_suspend"] : "0"),
            array("", "Player Active", (isset($data_player)) ? $data_player["player_active"] : "0")
        );

        $this->set_table_size(8, 20, 10, true);
        $this->set_table_style(0.3, false, true, false);
        $this->set_table_border_color(200, 200, 200);
        $this->set_table_font_color(100, 100, 100);
        $this->create_table($header, $player, $width, $header_align, $data_align);
        $this->SetFont('Arial', '', 13);
        $this->SetTextColor(100, 100, 100);
        $this->Cell(70, 7, 'Player Total', 0, 1, 'L');
        $this->Ln(2);
        $this->SetFont('Arial', '', 10);
        $this->MultiCell(135, 6, "Player state show active of passive playing behavior, keep active player increase everyday.");

        $this->SetFillColor(52, 73, 94);
        $this->SetTextColor(255, 255, 255);
        $this->SetLeftMargin(165);
        $this->SetY(130);
        $this->SetFont('Arial', 'B', 18);
        $this->Cell(25, 12, (isset($data_player)) ? $data_player["player_active"] + $data_player["player_suspend"] : "0", 0, 1, 'C', true);
        $this->SetLeftMargin(20);
        $this->Ln(20);

        // FEEDBACK REPORT
        $this->SetTextColor(50, 50, 50);
        $this->SetFont('Arial', 'B', 18);
        $this->Cell(70, 7, 'RESPONSE', 0, 1, 'L');
        $this->Ln(2);

        $width = array(10, 130, 30);
        $header = array('', 'FEEDBACK STATUS', 'TOTAL');
        $header_align = array("C", "L", "R");
        $data_align = array("C", "L", "R");
        $feedback = array(
            array("", "Today Traffic", (isset($data_feedback)) ? $data_feedback["feedback_today"] : "0"),
            array("", "Last Week Traffic", (isset($data_feedback)) ? $data_feedback["last_week"] : "0"),
            array("", "Last Month Traffic", (isset($data_feedback)) ? $data_feedback["last_month"] : "0"),
            array("", "Last Year Traffic", (isset($data_feedback)) ? $data_feedback["last_year"] : "0")
        );

        $this->set_table_size(8, 20, 10, true);
        $this->set_table_style(0.3, false, true, false);
        $this->set_table_border_color(200, 200, 200);
        $this->set_table_font_color(100, 100, 100);
        $this->create_table($header, $feedback, $width, $header_align, $data_align);
        $this->SetFont('Arial', '', 13);
        $this->SetTextColor(100, 100, 100);
        $this->Cell(70, 7, 'Total Feedback', 0, 1, 'L');
        $this->Ln(2);
        $this->SetFont('Arial', '', 10);
        $this->MultiCell(135, 6, "We do expect traffic will keep increase everyday and give us some suggest to improve our game.");

        $this->SetFillColor(52, 73, 94);
        $this->SetTextColor(255, 255, 255);
        $this->SetLeftMargin(165);
        $this->SetY(218);
        $this->SetFont('Arial', 'B', 18);
        $this->Cell(25, 12, (isset($data_feedback)) ? $data_feedback["total"] : "0", 0, 1, 'C', true);
        $this->SetLeftMargin(20);
        $this->Ln(50);


        // TRAFFIC REPORT
        $this->SetTextColor(50, 50, 50);
        $this->SetFont('Arial', 'B', 18);
        $this->Cell(70, 7, 'TRAFFIC', 0, 1, 'L');
        $this->Ln(2);

        $width = array(10, 130, 30);
        $header = array('', 'TRAFFIC STATUS', 'TOTAL');
        $header_align = array("C", "L", "R");
        $data_align = array("C", "L", "R");
        $traffic = array(
            array("", "Highest Traffic", (isset($data_traffic)) ? $data_traffic["max_traffic"] : "0"),
            array("", "Lowest Traffic", (isset($data_traffic)) ? $data_traffic["min_traffic"] : "0")
        );

        $this->set_table_size(8, 20, 10, true);
        $this->set_table_style(0.3, false, true, false);
        $this->set_table_border_color(200, 200, 200);
        $this->set_table_font_color(100, 100, 100);
        $this->create_table($header, $traffic, $width, $header_align, $data_align);
        $this->SetFont('Arial', '', 13);
        $this->SetTextColor(100, 100, 100);
        $this->Cell(70, 7, 'Average Trafiic / Day', 0, 1, 'L');
        $this->Ln(2);
        $this->SetFont('Arial', '', 10);
        $this->MultiCell(135, 6, "We do expect traffic will keep increase everyday and player more excite about Serious Game.");

        $this->SetFillColor(52, 73, 94);
        $this->SetTextColor(255, 255, 255);
        $this->SetLeftMargin(165);
        $this->SetY(92);
        $this->SetFont('Arial', 'B', 18);
        $this->Cell(25, 12, (isset($data_traffic)) ? $data_traffic["avg_traffic"] : "0", 0, 1, 'C', true);
        $this->SetLeftMargin(20);
        $this->Ln(20);


        // BEST PLAYER
        $this->SetTextColor(50, 50, 50);
        $this->SetFont('Arial', 'B', 18);
        $this->Cell(70, 7, 'FIRST STAGE', 0, 1, 'L');
        $this->Ln(2);

        if (isset($leaderboard)) {
            $avatar_path = __SITE_PATH . '/assets/images/avatar/' . $leaderboard[0]["ply_avatar"];
        } else {
            $avatar_path = __SITE_PATH . '/assets/images/avatar/' . "noimage.jpg";
        }


        // REPORT AVATAR PLAYER
        $this->Image($avatar_path, 26, 135, 30, 30, '', "http://localhost/businesscareer/player");


        // REPORT AVATAR INFORMATION
        $this->SetLeftMargin(65);
        $this->SetFont('Arial', '', 12);
        $this->SetTextColor(0, 0, 0);
        $this->Cell(40, 7, "Player Information", 0, 1);

        $this->SetFont('Arial', '', 10);

        $this->SetTextColor(100, 100, 100);
        $this->Cell(40, 7, "Email", 0, 0);
        $this->SetTextColor(105, 142, 43);
        $this->Cell(40, 7, (isset($leaderboard)) ? $leaderboard[0]["ply_email"] : "no email", 0, 1);

        $this->SetTextColor(100, 100, 100);
        $this->Cell(40, 7, "Name", 0, 0);
        $this->SetTextColor(105, 142, 43);
        $this->Cell(40, 7, (isset($leaderboard)) ? $leaderboard[0]["ply_name"] : "no name", 0, 1);

        $this->SetTextColor(100, 100, 100);
        $this->Cell(40, 7, "Balance", 0, 0);
        $this->SetTextColor(105, 142, 43);
        $this->Cell(40, 7, "IDR " . Utility::format_currency((isset($leaderboard)) ? $leaderboard[0]["ply_cash"] : 0), 0, 1);

        $this->SetTextColor(100, 100, 100);
        $this->Cell(40, 7, "Rating", 0, 0);
        for ($i = 0; $i < 5; $i++) {
            $this->Image(__SITE_PATH . '/assets/images/layout/star.png', ((isset($leaderboard)) ? $leaderboard[0]["ply_star"] : 0 * 6) + 105, 162, 4);
        }
        $this->SetLeftMargin(20);
        $this->Ln(10);

        $width = array(10, 130, 30);
        $header = array('', 'PLAYER STATUS', 'TOTAL');
        $header_align = array("C", "L", "R");
        $data_align = array("C", "L", "R");
        $this->player = array(
            array("", "Assets", "200"),
            array("", "Revenue", "210"),
            array("", "Equity", "200"),
            array("", "Payable", "200"),
            array("", "Receivable", "200")
        );

        $this->set_table_size(8, 20, 10, true);
        $this->set_table_style(0.3, false, true, false);
        $this->set_table_border_color(200, 200, 200);
        $this->set_table_font_color(100, 100, 100);
        $this->create_table($header, $this->player, $width, $header_align, $data_align);

        $this->SetFont('Arial', '', 13);
        $this->SetTextColor(100, 100, 100);
        $this->Cell(70, 7, 'Total Score', 0, 1, 'L');
        $this->Ln(2);
        $this->SetFont('Arial', '', 10);
        $this->MultiCell(135, 6, "We do expect traffic will keep increase everyday and player more excite about Serious Game.");

        $this->SetFillColor(52, 73, 94);
        $this->SetTextColor(255, 255, 255);
        $this->SetLeftMargin(165);
        $this->SetY(225);
        $this->SetFont('Arial', 'B', 18);
        $this->Cell(25, 12, '23', 0, 1, 'C', true);
        $this->SetLeftMargin(20);

        $this->SetTextColor(100, 100, 100);
        $this->Ln(10);
        $this->SetFont('Arial', '', 10);
        $this->Cell(0, 5, "Super Admin", 0, 1, "R");
        $this->Ln(3);
        $this->SetFont('Arial', 'B', 11);
        $this->SetTextColor(50, 50, 50);
        $this->Cell(0, 5, $_SESSION["web_name"], 0, 0, "R");
    }

    /**
     * output pdf preview
     */
    public function print_report()
    {
        $this->Output("Business Career Report.pdf", "I");
    }
} 