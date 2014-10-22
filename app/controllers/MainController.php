<?php

class MainController extends BaseController {

	public function getIndex()
	{
		View::share('title', 'Email Builder');
		return View::make('main');
	}

	public function getManage()
	{
		View::share('title', 'Manage');
		$data['success'] = Session::get('success', false);
		$data['fail'] = Session::get('fail', false);
		$data['blocks'] = Block::all();
		return View::make('manage', $data);
	}

	public function postBlocks()
	{
		$blocks = Block::all();
		echo json_encode($blocks);
	}

	public function getNewBlock()
	{
		View::share('title', 'New Block');
		$data['categories'] = Category::all();
		$data['brands'] = Brand::all();
		return View::make('edit-block', $data);
	}

	public function getEditBlock($id)
	{
		View::share('title', 'Edit Block');
		$data['categories'] = Category::all();
		$data['brands'] = Brand::all();
		$data['block'] = Block::find($id);
		return View::make('edit-block', $data);
	}

	public function postEditBlock()
	{
		if(Input::get('block_id')) {
			$block = Block::find(Input::get('block_id'));
		} else {
			$block = new Block;
		}
		$block->category_id = Input::get('category');
		$block->brand_id = Input::get('brand');
		$block->name = Input::get('name');
		$block->css = Input::get('css');
		$block->code = Input::get('code');
		$block->save();
		return Redirect::to('/manage')->with('success', 'Block saved successfully!');
	}

	public function postDeleteBlock()
	{
		$block = Block::find(Input::get('delete_id'));
		$block->delete();
		return Redirect::to('/manage')->with('success', 'Block deleted successfully!');
	}

	public function getCategories()
	{
		View::share('title', 'Edit Categories');
		$data['success'] = Session::get('success', false);
		$data['fail'] = Session::get('fail', false);
		$data['categories'] = Category::all();
		return View::make('categories', $data);
	}

	public function postEditCategory()
	{
		if(Input::get('category_id')) {
			$category = Category::find(Input::get('category_id'));
		} else {
			$category = new Category;
		}
		$category->name = Input::get('name');
		$category->save();
		return Redirect::to('/categories')->with('success', 'Category saved successfully!');
	}

	public function getBrands()
	{
		View::share('title', 'Edit Brands');
		$data['success'] = Session::get('success', false);
		$data['fail'] = Session::get('fail', false);
		$data['brands'] = Brand::all();
		return View::make('brands', $data);
	}

	public function postEditBrand()
	{

	}

}
