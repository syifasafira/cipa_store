use App\Models\Category;
use App\Models\Product;

Route::get('/debug-check', function () {
$categories = Category::all(['id', 'name', 'slug']);
$products = Product::with('category:id,name,slug')->get(['id', 'name', 'category_id']);

return response()->json([
'categories' => $categories,
'products' => $products,
]);
});