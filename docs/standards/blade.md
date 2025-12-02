# Padrões para Templates blade

## Estrutura
- Usar layouts (`resources/views/layouts/app.blade` ou `resources/views/layouts/guest.blade`) como base.
- Componentes reutilizáveis em `resources/veiws/components`.
- `app.blade` e `guest.blade` estão definidos como componentes, usar `x-app-layout` ou `x-guest-layout` para chamar.

## Boas práticas
- Usar `@foreach` e `@if` ao invés de php puro.
- Usar componentes para menus, links e formulários.
- Evitar lógica pesada dentro das views.

```blade
<x-nav-link :href="route('imoveis')" :active="request()->routeIs('imoveis')">Imóveis</x-nav-link>
```