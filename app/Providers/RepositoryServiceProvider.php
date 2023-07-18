<?php

namespace App\Providers;

use App\Models\OccasionPricing;
use App\Repositories\BaseRepository;
use Illuminate\Support\ServiceProvider;
use App\Repositories\RepositoryInterface;
use App\Repositories\Room\RoomRepository;
use App\Repositories\User\UserRepository;
use App\Repositories\Booking\BookingRepository;
use App\Repositories\Invoice\InvoiceRepository;
use App\Repositories\Customer\CustomerRepository;
use App\Repositories\Employee\EmployeeRepository;
use App\Repositories\Facility\FacilityRepository;
use App\Repositories\RoomType\RoomTypeRepository;
use App\Repositories\Room\RoomRepositoryInterface;
use App\Repositories\User\UserRepositoryInterface;
use App\Repositories\RoomBooking\RoomBookingRepository;
use App\Repositories\Booking\BookingRepositoryInterface;
use App\Repositories\Invoice\InvoiceRepositoryInterface;
use App\Repositories\FacilityType\FacilityTypeRepository;
use App\Repositories\Customer\CustomerRepositoryInterface;
use App\Repositories\Employee\EmployeeRepositoryInterface;
use App\Repositories\Facility\FacilityRepositoryInterface;
use App\Repositories\RoomType\RoomTypeRepositoryInterface;
use App\Repositories\OccasionPricing\OccasionPricingRepository;
use App\Repositories\RoomBooking\RoomBookingRepositoryInterface;
use App\Repositories\FacilityType\FacilityTypeRepositoryInterface;
use App\Repositories\OccasionPricing\OccasionPricingRepositoryInterface;
use App\Repositories\OccasionPricing_RoomType\OccasionPricing_RoomTypeRepository;
use App\Repositories\OccasionPricing_RoomType\OccasionPricing_RoomTypeRepositoryInterface;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(RepositoryInterface::class, BaseRepository::class);
        $this->app->bind(UserRepositoryInterface::class, UserRepository::class);
        $this->app->bind(BookingRepositoryInterface::class, BookingRepository::class);
        $this->app->bind(CustomerRepositoryInterface::class, CustomerRepository::class);
        $this->app->bind(EmployeeRepositoryInterface::class, EmployeeRepository::class);
        $this->app->bind(FacilityRepositoryInterface::class, FacilityRepository::class);
        $this->app->bind(FacilityTypeRepositoryInterface::class, FacilityTypeRepository::class);
        $this->app->bind(InvoiceRepositoryInterface::class, InvoiceRepository::class);
        $this->app->bind(OccasionPricingRepositoryInterface::class, OccasionPricingRepository::class);
        $this->app->bind(OccasionPricing_RoomTypeRepositoryInterface::class, OccasionPricing_RoomTypeRepository::class);
        $this->app->bind(RoomRepositoryInterface::class, RoomRepository::class);
        $this->app->bind(RoomTypeRepositoryInterface::class, RoomTypeRepository::class);
        $this->app->bind(RoomBookingRepositoryInterface::class, RoomBookingRepository::class);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
