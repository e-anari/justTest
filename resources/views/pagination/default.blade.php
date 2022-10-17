<?php
// config
$link_limit = 5; // maximum number of links (a little bit inaccurate, but will be ok for now)
?>

@if ($paginator->lastPage() > 1)
<div class="dataTables_paginate paging_simple_numbers" id="datatable-responsive_paginate">
    <ul class="pagination">

        <li class="paginate_button previous disabled" id="datatable-responsive_previous"><a
                href="{{ $paginator->url($paginator->perPage()) }}" aria-controls="datatable-responsive"
                tabindex="0">Previous</a></li>

        @for ($i = 1; $i <= $paginator->lastPage(); $i++)
            <?php
                $half_total_links = floor($link_limit / 2);
                $from = $paginator->currentPage() - $half_total_links;
                $to = $paginator->currentPage() + $half_total_links;
                if ($paginator->currentPage() < $half_total_links) {
                        $to += $half_total_links - $paginator->currentPage();
                    }
                    if ($paginator->lastPage() - $paginator->currentPage() < $half_total_links) {
                        $from -= $half_total_links - ($paginator->lastPage() - $paginator->currentPage()) - 1;
                    }
            ?>
            @if ($from < $i && $i < $to) <li
                class="paginate_button  {{ ($paginator->currentPage() == $i) ? 'active' : ''}}">
                <a aria-controls="datatable-responsive" tabindex="0"
                    href="{{ $paginator->url($i) }}">{{ $i }}</a>
                </li>
                @endif
                @endfor

                <li class="paginate_button next" id="datatable-responsive_next"><a
                        href="{{ $paginator->url($paginator->lastPage()) }}" aria-controls="datatable-responsive"
                        tabindex="0">Next</a></li>
    </ul>
</div>
@endif