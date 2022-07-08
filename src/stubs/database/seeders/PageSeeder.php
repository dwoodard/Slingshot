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
        $page = new \App\Models\Page();
        $page->title = 'Welcome';
        $page->slug = 'welcome';
        $page->source = '{"html":"<div class=\"gjs-row\"><div class=\"gjs-cell\"><div id=\"itm8\">Welcome from Pages<\/div><\/div><\/div>","components":"[{\"name\":\"Row\",\"droppable\":\".gjs-cell\",\"resizable\":{\"tl\":0,\"tc\":0,\"tr\":0,\"cl\":0,\"cr\":0,\"bl\":0,\"br\":0,\"minDim\":1},\"classes\":[{\"name\":\"gjs-row\",\"private\":1}],\"components\":[{\"name\":\"Cell\",\"draggable\":\".gjs-row\",\"resizable\":{\"tl\":0,\"tc\":0,\"tr\":0,\"cl\":0,\"cr\":1,\"bl\":0,\"br\":0,\"minDim\":1,\"bc\":0,\"currentUnit\":1,\"step\":0.2},\"classes\":[{\"name\":\"gjs-cell\",\"private\":1}],\"components\":[{\"type\":\"text\",\"attributes\":{\"id\":\"itm8\"},\"components\":[{\"type\":\"textnode\",\"removable\":false,\"draggable\":false,\"highlightable\":0,\"copyable\":false,\"selectable\":true,\"content\":\"Welcome from Pages\",\"_innertext\":false}]}]}]}]","assets":"[]","css":"* { box-sizing: border-box; } body {margin: 0;}.gjs-row{display:table;padding-top:10px;padding-right:10px;padding-bottom:10px;padding-left:10px;width:100%;}.gjs-cell{width:8%;display:table-cell;height:75px;}#itm8{padding:10px;}@media (max-width: 768px){.gjs-cell{width:100%;display:block;}}","styles":"[{\"selectors\":[{\"name\":\"gjs-row\",\"private\":1}],\"style\":{\"display\":\"table\",\"padding-top\":\"10px\",\"padding-right\":\"10px\",\"padding-bottom\":\"10px\",\"padding-left\":\"10px\",\"width\":\"100%\"}},{\"selectors\":[{\"name\":\"gjs-cell\",\"private\":1}],\"style\":{\"width\":\"100%\",\"display\":\"block\"},\"mediaText\":\"(max-width: 768px)\",\"atRuleType\":\"media\"},{\"selectors\":[\"gjs-cell30\"],\"style\":{\"width\":\"100%\",\"display\":\"block\"},\"mediaText\":\"(max-width: 768px)\",\"atRuleType\":\"media\"},{\"selectors\":[\"gjs-cell70\"],\"style\":{\"width\":\"100%\",\"display\":\"block\"},\"mediaText\":\"(max-width: 768px)\",\"atRuleType\":\"media\"},{\"selectors\":[{\"name\":\"gjs-cell\",\"private\":1}],\"style\":{\"width\":\"8%\",\"display\":\"table-cell\",\"height\":\"75px\"}},{\"selectors\":[\"#itm8\"],\"style\":{\"padding\":\"10px\"}}]"}';
        $page->is_published = true;
        $page->save();
    }
}
