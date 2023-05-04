<table>
  <thead>
    <tr>
      <th>Item ID</th>
      <th>Name</th>
      <th>Cost Price</th>
      <th>Selling Price</th>
    </tr>
  </thead>
  <tbody>
   
    @foreach($items as $item)
      <tr>
        <td>{{$item->item_id}}</td>
        <td>{{$item->description}}</td>
        <td>{{$item->cost_price}}</td>
        <td>{{$item->sell_price}}</td>
      </tr>
    @endforeach
  </tbody>
</table>