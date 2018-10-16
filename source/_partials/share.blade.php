<social-sharing url="{{ $page->getUrl() }}" title="{{ $page->title }}" inline-template>
    <div>
        <network network="facebook">
            <button class="button">
                <icon>fa-facebook</icon>
                <span>Facebook</span>
            </button>
        </network>
        <network network="twitter">
            <button class="button">
                <icon>fa-twitter</icon>
                <span>Twitter</span>
            </button>
        </network>
        <network network="reddit">
            <button class="button">
                <icon>fa-reddit-alien</icon>
                <span>Reddit</span>
            </button>
        </network>
        <network network="linkedin">
            <button class="button">
                <icon>fa-linkedin</icon>
                <span>LinkedIn</span>
            </button>
        </network>
    </div>
</social-sharing>
