<div class="pro-pagination" style="margin-bottom:100px">
  <nav>
    <ul class="blog-pagination">
    @if ($sanpham->currentPage() != 1)
      <li>
        <a href="{!! str_replace('/?','?',$sanpham->url($sanpham->currentPage() - 1)) !!}" aria-label="Previous">
          <span aria-hidden="true">&laquo;</span>
        </a>
      </li>
    @endif
    @for ($i = 1; $i <=  $sanpham->lastPage(); $i++)
      <li class="{!! ($sanpham->currentPage() == $i)? 'active':'' !!}"><a href="{!! str_replace('/?','?',$sanpham->url($i)) !!}">{!! $i !!}</a></li>
    @endfor
    @if ($sanpham->currentPage() != $sanpham->lastPage())
      <li>
        <a href="{!! str_replace('/?','?',$sanpham->url($sanpham->currentPage() + 1)) !!}" aria-label="Next">
          <span aria-hidden="true">&raquo;</span>
        </a>
      </li>
    @endif
      
    </ul>
  </nav>
  <!-- <div class="product-pagination">
  <span class="grid-item-list">Hiển thị từ 1 tới 6 của  ( {!! $sanpham->lastPage()!!} trang)</span>
  </div> -->
</div>
</div>
