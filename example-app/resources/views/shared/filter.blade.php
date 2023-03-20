<div class="row">
    <div class="col-md-6">
        <div class="row">
            <div class="col">
                <a href=" {{ request()->fullUrlwithQuery(['trash' => false])}}"  class="btn {{!request()->query('trash')? 'text-primary' : 'text-secodary'}} ">All</a>
                 |
                  <a href=" {{ request()->fullUrlwithQuery(['trash' => true])}}"  class="btn {{request()->query('trash')? 'text-primary' : 'text-secodary'}}">Trash</a>
            </div>
        </div>
    </div>
    <div class="col-md-6">
      <form action="" method="get">
        <input type="hidden" name="trash" value="{{ request()->query('trash')}}">
        <div class="row">
          <div class="col">

            @isset($filterDropDown)
            {{-- @includeWhen(!empty($companies), 'index._company_selection') --}}
            @includeIf('index._company_selection')
            @endisset


          </div>
          <div class="col">
            <div class="input-group mb-3">
              <input type="text" class="form-control" name="search" value="{{request()->query('search')}}" id="search-input" placeholder="Search..." aria-label="Search..." aria-describedby="button-addon2">
              <div class="input-group-append">
                 {{-- @if(request()->filled('search')) --}}
                    <button class="btn btn-outline-secondary" type="button" id= "reset-filter-search"  {{-- onclick="document.getElementById('search-input').value = '', document.getElementById('search-select').selectedIndex = 0,this.form.submit()"--}} >
                        <i class="fa fa-refresh"></i>
                        </button>
                  {{-- @endif --}}
                    <button class="btn btn-outline-secondary" type="submit" id="button-addon2">
                  <i class="fa fa-search"></i>
                </button>
              </div>
            </div>
          </div>
        </div>
      </form>
    </div>
  </div>

  @push('scripts')

  <script>
      document.getElementById('reset-filter-search').addEventListener('click', () =>{

    let input = document.getElementById('search-input')

     let selects = document.querySelectorAll('.search-select');

     if(input){
        input.value = '';
     }
     selects.forEach(
        select =>{

            select.selectedIndex = 0;
        });

        window.location.href = window.location.href.split('?')[0]

    });

    const toggleClearButton = () => {
        let query = location.search;
        let pattern = /[?&]search=/;
        let button = document.getElementById('reset-filter-search');

        if(pattern.test(query)){
          button.style.display = 'block';
        }else{
          button.style.display = 'none';
        }
    }

    toggleClearButton();
  </script>
  @endpush
