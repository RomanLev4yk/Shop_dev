<?php

use Illuminate\Database\Seeder;

class VariablesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$indexPage = App\Model\Page::select('id', 'url')
    		->where('url', '/')
    		->firstOrFail();

        $indexSlider = App\Model\Variable::create([
        	'name' => 'indexSlider',
        	'title' => 'Index slider',
        	'description' => '-'
        ]);

        $titleColumn = App\Model\MultiColumnVariable::create([
        	'name' => 'title',
        	'variable_id' => $indexSlider->id
        ]);

        $descriptionColumn = App\Model\MultiColumnVariable::create([
        	'name' => 'description',
        	'variable_id' => $indexSlider->id
        ]);

        $imageColumn = App\Model\MultiColumnVariable::create([
        	'name' => 'image',
        	'variable_id' => $indexSlider->id
        ]);

        $linkColumn = App\Model\MultiColumnVariable::create([
        	'name' => 'link',
        	'variable_id' => $indexSlider->id
        ]);

        $firstSlide = App\Model\MultiLineVariable::create([
        	'variable_id' => $titleColumn->id,
        	'page_id' => $indexPage->id
        ]);
        App\Model\MultiVariableContent::create([
            'multi_line_variable_id' => $firstSlide->id,
            'multi_column_variable_id' => $titleColumn->id,
            'content' => 'Example slide 1'
        ]);
        App\Model\MultiVariableContent::create([
            'multi_line_variable_id' => $firstSlide->id,
            'multi_column_variable_id' => $descriptionColumn->id,
            'content' => 'Example description slide 1'
        ]);
        App\Model\MultiVariableContent::create([
            'multi_line_variable_id' => $firstSlide->id,
            'multi_column_variable_id' => $imageColumn->id,
            'content' => 'https://conversation.which.co.uk/wp-content/uploads/2017/10/60-products-1.jpg'
        ]);
        App\Model\MultiVariableContent::create([
            'multi_line_variable_id' => $firstSlide->id,
            'multi_column_variable_id' => $linkColumn->id,
            'content' => 'https://conversation.which.co.uk'
        ]);

        $secondSlide = App\Model\MultiLineVariable::create([
            'variable_id' => $titleColumn->id,
            'page_id' => $indexPage->id
        ]);
        App\Model\MultiVariableContent::create([
            'multi_line_variable_id' => $secondSlide->id,
            'multi_column_variable_id' => $titleColumn->id,
            'content' => 'Example slide 2'
        ]);
        App\Model\MultiVariableContent::create([
            'multi_line_variable_id' => $secondSlide->id,
            'multi_column_variable_id' => $descriptionColumn->id,
            'content' => 'Example description slide 2'
        ]);
        App\Model\MultiVariableContent::create([
            'multi_line_variable_id' => $secondSlide->id,
            'multi_column_variable_id' => $imageColumn->id,
            'content' => 'https://cdn.firespring.com/images/707a74f7-63d0-4c2c-8d14-5d4cc426c8c3.gif'
        ]);
        App\Model\MultiVariableContent::create([
            'multi_line_variable_id' => $secondSlide->id,
            'multi_column_variable_id' => $linkColumn->id,
            'content' => 'http://google.com'
        ]);
    }
}
