<div>
    <a class="nav-link" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <i class="fa fa-bell" aria-hidden="true"></i>
        @if ($notifications->count()>0)
            <span class="badge badge-md badge-circle badge-floating badge-danger border-white">{{ $notifications->count() }}</span>
        @endif
    </a>
    <div class="dropdown-menu dropdown-menu-xl dropdown-menu-right py-0 overflow-hidden" style="max-width: 80px;">
        <!-- Dropdown header -->
        <div class="list-group list-group-flush">
            @forelse ($notifications as $notification)
                <a href="{{ $notification->data['link'] }}" class="list-group-item list-group-item-action">
                    <div class="row align-items-center">
                    <div class="col-auto">
                        <!-- Avatar -->
                        <i class="far fa-bell" style="font-size:20px"></i>
                    </div>
                    <div class="col ml--2">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h4 class="mb-0 text-sm">{{ $notification->data['subject'] }}</h4>
                            </div>
                            <div class="text-right text-muted">
                                <small>{{ $notification->created_at->diffForHumans() }}</small>
                            </div>
                        </div>
                        <p class="text-sm mb-0">{{ $notification->data['body'] }}</p>
                    </div>
                    </div>
                </a>
            @empty
                <div class="px-3 py-3 text-center">
                    <h6 class="text-sm text-muted m-0">You don't have any notification</h6>
                </div>
            @endforelse
          </div>
        <!-- View all -->
        @if ($notifications->count()>0)
        <a href="#!" wire:click="markAllAsRead" class="dropdown-item text-center text-primary font-weight-bold py-3">
            {{ __('Mark all as read') }}
        </a>
        @endif
    </div>
</div>
