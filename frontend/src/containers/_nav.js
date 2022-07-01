

var modules = [{
  _name: 'CSidebarNavItem',
  name: 'Inicio',
  to: '/inicio/inicio',
  icon: 'cilHome',
}];

modules.push({
  _name: 'CSidebarNavItem',
  name: 'Clientes',
  to: '/cliente/listar',
  icon: 'cil-people',
});

modules.push({
  _name: 'CSidebarNavItem',
  name: 'Recargas',
  to: '/recargas/listar',
  icon: 'cilCash',
});



let report = {
  _name: 'CSidebarNavDropdown',
  name: 'Reporte',
  icon: 'cilFile',
  items: [
    { name: 'Recargas', to: '/reporte/recargas'},
    { name: 'Recargas Anuladas', to: '/reporte/recargas-anuladas'}
  ]
}
modules.push(report);

export default [
  {
    _name: 'CSidebarNav',
    _children: modules
  }
]