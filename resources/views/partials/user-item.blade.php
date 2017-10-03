<div class="small-12 medium-4 large-3 columns user">
    <div class="row">
        <div class="small-2 medium-2 large-2 columns padding-zeroed">
            <img src="{{ asset('images/profile-pics/1.jpg') }}" alt="">
        </div>
        <div class="small-10 medium-10 large-10 columns user-infos">
            <span class="user-infos-name"><a href="{{ route('user-show', $user) }}">{{ $user->name }}</a></span>
            <span class="user-infos-addr">{{ $user->address, 30 }}</span>
            <span class="user-infos-repo">{{ $user->reputation }}</span>
            <div class="user-infos-tags">
                <ul>
                    @foreach($user->usedTags() as $tag)
                        <li><a href="{{ route('tag-show', $tag->id) }}">{{ $tag->name }}</a></li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</div>