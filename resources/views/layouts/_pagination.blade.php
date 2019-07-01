@if ($paginator->hasPages())
<ul class="pagination" role="navigation">
  {{-- Previous Page Link --}}
  @if ($paginator->onFirstPage())
  <li class="prev" class="disabled" aria-disabled="true"><span>&lt; prev</span></li>
  @else
  <li class="prev"><a href="{{ $paginator->previousPageUrl() }}" rel="prev">&lt; prev</a></li>
  @endif

  {{-- Next Page Link --}}
  @if ($paginator->hasMorePages())
  <li class="next"><a href="{{ $paginator->nextPageUrl() }}" rel="next">next &gt;</a></li>
  @else
  <li class="next" class="disabled" aria-disabled="true"><span>next &gt;</span></li>
  @endif
</ul>
@endif
