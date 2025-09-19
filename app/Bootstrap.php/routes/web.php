// Opción rápida (closure)
use App\Models\Device;   // cambia por el nombre de tu modelo
use App\Models\Registro; // cambia por el nombre de tu modelo

Route::get('/dashboard', function () {
    $online = Device::count(); // ajusta según tu columna
    $last = Registro::latest()->first();
    $lastDiff = $last ? $last->created_at->diffForHumans() : 'Sin registros';
    $db = config('database.default'); // 'pgsql' o lo que tengas
    return view('dashboard', compact('online','lastDiff','db'));
})->name('dashboard');
Route::get('/dashboard', [\App\Http\Controllers\DashboardController::class, 'index'])->name('dashboard');
