<div class="rbt-dashboard-content-wrapper">
    <div class="tutor-bg-photo bg_image height-350"
        style="background-image: url('{{ $user->banner ? asset('storage/' . $user->banner) : asset('assets/images/about/banner.svg') }}'); background-position: center;">
    </div>

    <div class="rbt-tutor-information">
        <div class="rbt-tutor-information-left">

            <div class="thumbnail rbt-avatars size-lg">
                <div class="thumbnail rbt-avatars size-lg">
                    <img style="object-fit: cover; object-position: center; width: 100%; height: 100%;"
                        src="{{ $user->profile ? asset('storage/' . $user->profile) : asset('assets/images/about/avatar.svg') }}"
                        alt="{{ $user->name }}">
                </div>
            </div>
            <div class="tutor-content">
                <h4 class="title">{{ $user->name }}</h4>
                <div class="username">
                    <p class="feature-title color-white">@<span>{{ $user->username }}</span></p>
                </div>
            </div>

        </div>
    </div>
</div>
