<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class PageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // create a welcome page
        $welcome = new \App\Models\Page();
        $welcome->title = 'Home';
        $welcome->link = '/welcome';
        $welcome->source = '{"html":"<div class=\"gjs-row\" id=\"i8cp\"><div class=\"gjs-cell\" id=\"iiog\"><div id=\"itm8\">Header<\/div><\/div><div class=\"gjs-cell\" id=\"i7ylr\"><div id=\"irah6\">1<\/div><\/div><div class=\"gjs-cell\" id=\"iy1s7\"><div id=\"im1r\">2<\/div><\/div><div class=\"gjs-cell\" id=\"i3iwl\"><div id=\"ivpd5\">3<\/div><\/div><div class=\"gjs-cell\" id=\"ie87g\"><div id=\"iz2lk\">4<\/div><\/div><div class=\"gjs-cell\" id=\"ieqcs\"><div id=\"ig4vp\">Footer<\/div><\/div><\/div>","components":"[{\"name\":\"Row\",\"droppable\":\".gjs-cell\",\"resizable\":{\"tl\":0,\"tc\":0,\"tr\":0,\"cl\":0,\"cr\":0,\"bl\":0,\"br\":0,\"minDim\":1},\"classes\":[{\"name\":\"gjs-row\",\"private\":1}],\"attributes\":{\"id\":\"i8cp\"},\"components\":[{\"name\":\"Cell\",\"draggable\":\".gjs-row\",\"resizable\":{\"tl\":0,\"tc\":0,\"tr\":0,\"cl\":0,\"cr\":1,\"bl\":0,\"br\":0,\"minDim\":1,\"bc\":0,\"currentUnit\":1,\"step\":0.2},\"classes\":[{\"name\":\"gjs-cell\",\"private\":1}],\"attributes\":{\"id\":\"iiog\"},\"components\":[{\"type\":\"text\",\"attributes\":{\"id\":\"itm8\"},\"components\":[{\"type\":\"textnode\",\"removable\":false,\"draggable\":false,\"highlightable\":0,\"copyable\":false,\"selectable\":true,\"content\":\"Header\",\"_innertext\":false}]}]},{\"name\":\"Cell\",\"draggable\":\".gjs-row\",\"resizable\":{\"tl\":0,\"tc\":0,\"tr\":0,\"cl\":0,\"cr\":1,\"bl\":0,\"br\":0,\"minDim\":1,\"bc\":0,\"currentUnit\":1,\"step\":0.2},\"classes\":[{\"name\":\"gjs-cell\",\"private\":1}],\"attributes\":{\"id\":\"i7ylr\"},\"components\":[{\"type\":\"text\",\"attributes\":{\"id\":\"irah6\"},\"components\":[{\"type\":\"textnode\",\"removable\":false,\"draggable\":false,\"highlightable\":0,\"copyable\":false,\"selectable\":true,\"content\":\"1\",\"_innertext\":false}]}]},{\"name\":\"Cell\",\"draggable\":\".gjs-row\",\"resizable\":{\"tl\":0,\"tc\":0,\"tr\":0,\"cl\":0,\"cr\":1,\"bl\":0,\"br\":0,\"minDim\":1,\"bc\":0,\"currentUnit\":1,\"step\":0.2},\"classes\":[{\"name\":\"gjs-cell\",\"private\":1}],\"attributes\":{\"id\":\"iy1s7\"},\"components\":[{\"type\":\"text\",\"attributes\":{\"id\":\"im1r\"},\"components\":[{\"type\":\"textnode\",\"removable\":false,\"draggable\":false,\"highlightable\":0,\"copyable\":false,\"selectable\":true,\"content\":\"2\",\"_innertext\":false}]}]},{\"name\":\"Cell\",\"draggable\":\".gjs-row\",\"resizable\":{\"tl\":0,\"tc\":0,\"tr\":0,\"cl\":0,\"cr\":1,\"bl\":0,\"br\":0,\"minDim\":1,\"bc\":0,\"currentUnit\":1,\"step\":0.2},\"classes\":[{\"name\":\"gjs-cell\",\"private\":1}],\"attributes\":{\"id\":\"i3iwl\"},\"components\":[{\"type\":\"text\",\"attributes\":{\"id\":\"ivpd5\"},\"components\":[{\"type\":\"textnode\",\"removable\":false,\"draggable\":false,\"highlightable\":0,\"copyable\":false,\"selectable\":true,\"content\":\"3\",\"_innertext\":false}]}]},{\"name\":\"Cell\",\"draggable\":\".gjs-row\",\"resizable\":{\"tl\":0,\"tc\":0,\"tr\":0,\"cl\":0,\"cr\":1,\"bl\":0,\"br\":0,\"minDim\":1,\"bc\":0,\"currentUnit\":1,\"step\":0.2},\"classes\":[{\"name\":\"gjs-cell\",\"private\":1}],\"attributes\":{\"id\":\"ie87g\"},\"components\":[{\"type\":\"text\",\"attributes\":{\"id\":\"iz2lk\"},\"components\":[{\"type\":\"textnode\",\"removable\":false,\"draggable\":false,\"highlightable\":0,\"copyable\":false,\"selectable\":true,\"content\":\"4\",\"_innertext\":false}]}]},{\"name\":\"Cell\",\"draggable\":\".gjs-row\",\"resizable\":{\"tl\":0,\"tc\":0,\"tr\":0,\"cl\":0,\"cr\":1,\"bl\":0,\"br\":0,\"minDim\":1,\"bc\":0,\"currentUnit\":1,\"step\":0.2},\"classes\":[{\"name\":\"gjs-cell\",\"private\":1}],\"attributes\":{\"id\":\"ieqcs\"},\"components\":[{\"type\":\"text\",\"attributes\":{\"id\":\"ig4vp\"},\"components\":[{\"type\":\"textnode\",\"removable\":false,\"draggable\":false,\"highlightable\":0,\"copyable\":false,\"selectable\":true,\"content\":\"Footer\",\"_innertext\":false}]}]}]}]","assets":"[]","css":"* { box-sizing: border-box; } body {margin: 0;}.gjs-row{display:table;padding-top:10px;padding-right:10px;padding-bottom:10px;padding-left:10px;width:100%;}.gjs-cell{width:8%;display:table-cell;height:75px;}#itm8{padding:10px;}#iiog{flex-grow:1;flex-basis:100%;text-align:center;}#im1r{padding:10px;text-align:center;}#iy1s7{flex-grow:1;}#irah6{padding:10px;text-align:center;}#i7ylr{flex-grow:1;}#i8cp{display:flex;flex-wrap:wrap;}#ig4vp{padding:10px;text-align:center;}#ieqcs{flex-basis:100%;}#ivpd5{padding:10px;text-align:center;}#i3iwl{flex-grow:1;}#iz2lk{padding:10px;text-align:center;}#ie87g{flex-grow:1;}@media (max-width: 768px){.gjs-cell{width:100%;display:block;}}","styles":"[{\"selectors\":[{\"name\":\"gjs-row\",\"private\":1}],\"style\":{\"display\":\"table\",\"padding-top\":\"10px\",\"padding-right\":\"10px\",\"padding-bottom\":\"10px\",\"padding-left\":\"10px\",\"width\":\"100%\"}},{\"selectors\":[{\"name\":\"gjs-cell\",\"private\":1}],\"style\":{\"width\":\"100%\",\"display\":\"block\"},\"mediaText\":\"(max-width: 768px)\",\"atRuleType\":\"media\"},{\"selectors\":[\"gjs-cell30\"],\"style\":{\"width\":\"100%\",\"display\":\"block\"},\"mediaText\":\"(max-width: 768px)\",\"atRuleType\":\"media\"},{\"selectors\":[\"gjs-cell70\"],\"style\":{\"width\":\"100%\",\"display\":\"block\"},\"mediaText\":\"(max-width: 768px)\",\"atRuleType\":\"media\"},{\"selectors\":[{\"name\":\"gjs-cell\",\"private\":1}],\"style\":{\"width\":\"8%\",\"display\":\"table-cell\",\"height\":\"75px\"}},{\"selectors\":[\"#itm8\"],\"style\":{\"padding\":\"10px\"}},{\"selectors\":[\"#iiog\"],\"style\":{\"flex-grow\":\"1\",\"flex-basis\":\"100%\",\"text-align\":\"center\"}},{\"selectors\":[\"#im1r\"],\"style\":{\"padding\":\"10px\",\"text-align\":\"center\"}},{\"selectors\":[\"#iy1s7\"],\"style\":{\"flex-grow\":\"1\"}},{\"selectors\":[\"#irah6\"],\"style\":{\"padding\":\"10px\",\"text-align\":\"center\"}},{\"selectors\":[\"#i7ylr\"],\"style\":{\"flex-grow\":\"1\"}},{\"selectors\":[\"#i8cp\"],\"style\":{\"display\":\"flex\",\"flex-wrap\":\"wrap\"}},{\"selectors\":[\"#ig4vp\"],\"style\":{\"padding\":\"10px\",\"text-align\":\"center\"}},{\"selectors\":[\"#ieqcs\"],\"style\":{\"flex-basis\":\"100%\"}},{\"selectors\":[\"#ivpd5\"],\"style\":{\"padding\":\"10px\",\"text-align\":\"center\"}},{\"selectors\":[\"#i3iwl\"],\"style\":{\"flex-grow\":\"1\"}},{\"selectors\":[\"#iz2lk\"],\"style\":{\"padding\":\"10px\",\"text-align\":\"center\"}},{\"selectors\":[\"#ie87g\"],\"style\":{\"flex-grow\":\"1\"}}]"}';
        $welcome->is_published = true;
        $welcome->save();

        // create a about page
        $about = new \App\Models\Page();
        $about->title = 'About';
        $about->link = '/about';
        $about->source = '{"html":"<div class=\"gjs-row\"><div class=\"gjs-cell\"><div id=\"itm8\">About<\/div><\/div><\/div>","components":"[{\"name\":\"Row\",\"droppable\":\".gjs-cell\",\"resizable\":{\"tl\":0,\"tc\":0,\"tr\":0,\"cl\":0,\"cr\":0,\"bl\":0,\"br\":0,\"minDim\":1},\"classes\":[{\"name\":\"gjs-row\",\"private\":1}],\"components\":[{\"name\":\"Cell\",\"draggable\":\".gjs-row\",\"resizable\":{\"tl\":0,\"tc\":0,\"tr\":0,\"cl\":0,\"cr\":1,\"bl\":0,\"br\":0,\"minDim\":1,\"bc\":0,\"currentUnit\":1,\"step\":0.2},\"classes\":[{\"name\":\"gjs-cell\",\"private\":1}],\"components\":[{\"type\":\"text\",\"attributes\":{\"id\":\"itm8\"},\"components\":[{\"type\":\"textnode\",\"removable\":false,\"draggable\":false,\"highlightable\":0,\"copyable\":false,\"selectable\":true,\"content\":\"Welcome from Pages\",\"_innertext\":false}]}]}]}]","assets":"[]","css":"* { box-sizing: border-box; } body {margin: 0;}.gjs-row{display:table;padding-top:10px;padding-right:10px;padding-bottom:10px;padding-left:10px;width:100%;}.gjs-cell{width:8%;display:table-cell;height:75px;}#itm8{padding:10px;}@media (max-width: 768px){.gjs-cell{width:100%;display:block;}}","styles":"[{\"selectors\":[{\"name\":\"gjs-row\",\"private\":1}],\"style\":{\"display\":\"table\",\"padding-top\":\"10px\",\"padding-right\":\"10px\",\"padding-bottom\":\"10px\",\"padding-left\":\"10px\",\"width\":\"100%\"}},{\"selectors\":[{\"name\":\"gjs-cell\",\"private\":1}],\"style\":{\"width\":\"100%\",\"display\":\"block\"},\"mediaText\":\"(max-width: 768px)\",\"atRuleType\":\"media\"},{\"selectors\":[\"gjs-cell30\"],\"style\":{\"width\":\"100%\",\"display\":\"block\"},\"mediaText\":\"(max-width: 768px)\",\"atRuleType\":\"media\"},{\"selectors\":[\"gjs-cell70\"],\"style\":{\"width\":\"100%\",\"display\":\"block\"},\"mediaText\":\"(max-width: 768px)\",\"atRuleType\":\"media\"},{\"selectors\":[{\"name\":\"gjs-cell\",\"private\":1}],\"style\":{\"width\":\"8%\",\"display\":\"table-cell\",\"height\":\"75px\"}},{\"selectors\":[\"#itm8\"],\"style\":{\"padding\":\"10px\"}}]"}';
        $about->is_published = true;
        $about->save();
    }
}
