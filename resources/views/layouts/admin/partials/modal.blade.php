<!-- Notifications Modal -->
<div class="modal fade modal-notif modal-slide" tabindex="-1" role="dialog" aria-labelledby="notifModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content shadow-lg border-0" style="border-radius: 1.25rem; overflow: hidden;">
            <div class="modal-header bg-white border-bottom-0 pb-2 pt-4 px-4">
                <h5 class="modal-title font-weight-bold text-dark" id="notifModalLabel">Notifications</h5>
                <button type="button" class="close text-muted" data-dismiss="modal" aria-label="Close" style="opacity: 0.8; transition: 0.2s;">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body p-0">
                <div class="list-group list-group-flush px-2 pb-2">
                    <!-- Item 1 -->
                    <div class="list-group-item bg-transparent border-0 mb-2 rounded-lg hover-bg-light" style="transition: 0.2s;">
                        <div class="row align-items-center">
                            <div class="col-auto">
                                <div class="bg-success-light text-success rounded-circle d-flex align-items-center justify-content-center" style="width: 42px; height: 42px; background: rgba(40, 167, 69, 0.1);">
                                    <span class="fe fe-box fe-16"></span>
                                </div>
                            </div>
                            <div class="col pl-0">
                                <div class="d-flex justify-content-between align-items-center mb-1">
                                    <span class="font-weight-bold text-dark" style="font-size: 0.85rem;">Package uploaded</span>
                                    <small class="text-muted" style="font-size: 0.7rem;">1m ago</small>
                                </div>
                                <div class="text-muted text-truncate" style="font-size: 0.75rem; max-width: 140px;">Package is zipped and uploaded</div>
                            </div>
                        </div>
                    </div>
                    <!-- Item 2 -->
                    <div class="list-group-item bg-transparent border-0 mb-2 rounded-lg hover-bg-light" style="transition: 0.2s;">
                        <div class="row align-items-center">
                            <div class="col-auto">
                                <div class="bg-primary-light text-primary rounded-circle d-flex align-items-center justify-content-center" style="width: 42px; height: 42px; background: rgba(0, 123, 255, 0.1);">
                                    <span class="fe fe-download fe-16"></span>
                                </div>
                            </div>
                            <div class="col pl-0">
                                <div class="d-flex justify-content-between align-items-center mb-1">
                                    <span class="font-weight-bold text-dark" style="font-size: 0.85rem;">Widgets updated</span>
                                    <small class="text-muted" style="font-size: 0.7rem;">2m ago</small>
                                </div>
                                <div class="text-muted text-truncate" style="font-size: 0.75rem; max-width: 140px;">Just created new layouts</div>
                            </div>
                        </div>
                    </div>
                    <!-- Item 3 -->
                    <div class="list-group-item bg-transparent border-0 rounded-lg hover-bg-light" style="transition: 0.2s;">
                        <div class="row align-items-center">
                            <div class="col-auto">
                                <div class="bg-warning-light text-warning rounded-circle d-flex align-items-center justify-content-center" style="width: 42px; height: 42px; background: rgba(255, 193, 7, 0.1);">
                                    <span class="fe fe-inbox fe-16"></span>
                                </div>
                            </div>
                            <div class="col pl-0">
                                <div class="d-flex justify-content-between align-items-center mb-1">
                                    <span class="font-weight-bold text-dark" style="font-size: 0.85rem;">Notice sent</span>
                                    <small class="text-muted" style="font-size: 0.7rem;">30m ago</small>
                                </div>
                                <div class="text-muted text-truncate" style="font-size: 0.75rem; max-width: 140px;">Fusce dapibus tellus ac cursus</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer border-0 pt-0 pb-4 px-4">
                <button type="button" class="btn btn-light btn-block text-primary font-weight-bold" data-dismiss="modal" style="border-radius: 0.75rem; background: #f8f9fa;">Clear All</button>
            </div>
        </div>
    </div>
</div>

<!-- Shortcuts Modal -->
<div class="modal fade modal-shortcut modal-slide" tabindex="-1" role="dialog" aria-labelledby="shortcutModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content shadow-lg border-0" style="border-radius: 1.25rem; overflow: hidden; background: #fafbfc;">
            <div class="modal-header border-bottom-0 pb-2 pt-4 px-5">
                <h5 class="modal-title font-weight-bold text-dark" id="shortcutModalLabel">Quick Shortcuts</h5>
                <button type="button" class="close text-muted" data-dismiss="modal" aria-label="Close" style="opacity: 0.8; transition: 0.2s;">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body px-5 py-4">
                <div class="row mb-4">
                    <div class="col-6 text-center">
                        <a href="#" class="text-decoration-none text-dark bg-white d-block p-4 rounded-lg hover-shadow transition-all" style="box-shadow: 0 4px 15px rgba(0,0,0,0.03); border: 1px solid rgba(0,0,0,0.02); transition: 0.3s; border-radius: 1rem;">
                            <div class="squircle justify-content-center mb-3 mx-auto" style="width: 65px; height: 65px; background: linear-gradient(135deg, #0d6efd 0%, #0a58ca 100%); border-radius: 18px; display: flex;">
                                <i class="fe fe-cpu fe-24 align-self-center text-white"></i>
                            </div>
                            <p class="mb-0 font-weight-bold text-secondary" style="font-size: 0.85rem;">Control Area</p>
                        </a>
                    </div>
                    <div class="col-6 text-center">
                        <a href="{{ route('category.index') ?? '#' }}" class="text-decoration-none text-dark bg-white d-block p-4 rounded-lg hover-shadow transition-all" style="box-shadow: 0 4px 15px rgba(0,0,0,0.03); border: 1px solid rgba(0,0,0,0.02); transition: 0.3s; border-radius: 1rem;">
                            <div class="squircle justify-content-center mb-3 mx-auto" style="width: 65px; height: 65px; background: linear-gradient(135deg, #10b981 0%, #059669 100%); border-radius: 18px; display: flex;">
                                <i class="fe fe-activity fe-24 align-self-center text-white"></i>
                            </div>
                            <p class="mb-0 font-weight-bold text-secondary" style="font-size: 0.85rem;">Activity</p>
                        </a>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6 text-center">
                        <a href="{{ route('users.index') ?? '#' }}" class="text-decoration-none text-dark bg-white d-block p-4 rounded-lg hover-shadow transition-all" style="box-shadow: 0 4px 15px rgba(0,0,0,0.03); border: 1px solid rgba(0,0,0,0.02); transition: 0.3s; border-radius: 1rem;">
                            <div class="squircle justify-content-center mb-3 mx-auto" style="width: 65px; height: 65px; background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%); border-radius: 18px; display: flex;">
                                <i class="fe fe-users fe-24 align-self-center text-white"></i>
                            </div>
                            <p class="mb-0 font-weight-bold text-secondary" style="font-size: 0.85rem;">Users</p>
                        </a>
                    </div>
                    <div class="col-6 text-center">
                        <a href="#" class="text-decoration-none text-dark bg-white d-block p-4 rounded-lg hover-shadow transition-all" style="box-shadow: 0 4px 15px rgba(0,0,0,0.03); border: 1px solid rgba(0,0,0,0.02); transition: 0.3s; border-radius: 1rem;">
                            <div class="squircle justify-content-center mb-3 mx-auto" style="width: 65px; height: 65px; background: linear-gradient(135deg, #6366f1 0%, #4f46e5 100%); border-radius: 18px; display: flex;">
                                <i class="fe fe-settings fe-24 align-self-center text-white"></i>
                            </div>
                            <p class="mb-0 font-weight-bold text-secondary" style="font-size: 0.85rem;">Settings</p>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .hover-bg-light:hover {
        background-color: #f8f9fa !important;
        cursor: pointer;
    }
    .hover-shadow:hover {
        box-shadow: 0 10px 25px rgba(0,0,0,0.06) !important;
        transform: translateY(-4px);
    }
    .transition-all {
        transition: all 0.3s ease;
    }
</style>