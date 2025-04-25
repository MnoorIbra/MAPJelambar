php
use App\Http\Controllers\EdcMachineController;
use Illuminate\Support\Facades\Route;

Route::get('/api/edc-machines', [EdcMachineController::class, 'index']);