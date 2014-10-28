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
		$data['categories'] = Category::orderBy('name')->get();
		$data['brands'] = Brand::orderBy('name')->get();
		return View::make('manage', $data);
	}

	public function postBlocks()
	{
		$blocks = new Block;
		if(Input::get('filters.name'))
		{
			$name = Input::get('filters.name');
			$blocks = $blocks->where('name', 'LIKE', "%$name%");
		}
		if(Input::get('filters.category'))
		{
			$blocks = $blocks->where('category_id', Input::get('filters.category'));
		}
		if(Input::get('filters.brand'))
		{
			$blocks = $blocks->where('brand_id', Input::get('filters.brand'));
		}
		$blocks = $blocks->orderBy('name')->get();
		echo $blocks;
	}

	public function getNewBlock()
	{
		View::share('title', 'New Block');
		$data['categories'] = Category::orderBy('name')->get();
		$data['brands'] = Brand::orderBy('name')->get();
		return View::make('edit-block', $data);
	}

	public function getEditBlock($id)
	{
		View::share('title', 'Edit Block');
		$data['categories'] = Category::orderBy('name')->get();
		$data['brands'] = Brand::orderBy('name')->get();
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
		$data['categories'] = Category::orderBy('name')->get();
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

	public function postDeleteCategory()
	{
		$category = Category::find(Input::get('delete_id'));
		$category->delete();
		return Redirect::to('/categories')->with('success', 'Category deleted successfully!');
	}

	public function getBrands()
	{
		View::share('title', 'Edit Brands');
		$data['success'] = Session::get('success', false);
		$data['fail'] = Session::get('fail', false);
		$data['brands'] = Brand::orderBy('name')->get();
		return View::make('brands', $data);
	}

	public function postEditBrand()
	{
		if(Input::get('brand_id')) {
			$brand = Brand::find(Input::get('brand_id'));
		} else {
			$brand = new Brand;
		}
		$brand->name = Input::get('name');
		$brand->save();
		return Redirect::to('/brands')->with('success', 'Brand saved successfully!');
	}

	public function postDeleteBrand()
	{
		$brand = Brand::find(Input::get('delete_id'));
		$brand->delete();
		return Redirect::to('/brands')->with('success', 'Brand deleted successfully!');
	}

}
