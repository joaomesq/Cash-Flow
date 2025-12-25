document.addEventListener('DOMContentLoaded', () => {

  /* =====================
     DADOS GRÁFICO DE PIZZA
  ===================== */
  const receitasValor = Math.floor(Math.random() * 80000) + 20000;
  const despesasValor = Math.floor(Math.random() * 50000) + 10000;
  const totalOrcamento = 150000;

  const percReceitas = (receitasValor / totalOrcamento) * 100;
  const percDespesas = (despesasValor / totalOrcamento) * 100;
  const percVazio = 100 - percReceitas - percDespesas;

  const segmentsData = [
    { value: percReceitas, color: '#2563EB' },
    { value: percDespesas, color: '#EC4899' },
    { value: percVazio, color: document.documentElement.classList.contains('dark') ? '#4B5563' : '#D1D5DB' }
  ];

  const segmentsGroup = document.getElementById('segments');
  const percentualCentral = document.getElementById('percentual');
  const percentualExterno = document.getElementById('percentual-externo');
  const centro = document.getElementById('central');

  function polarToCartesian(cx, cy, r, angle) {
    const rad = (angle - 90) * Math.PI / 180;
    return { x: cx + r * Math.cos(rad), y: cy + r * Math.sin(rad) };
  }

  function describeArc(cx, cy, r, start, end) {
    const s = polarToCartesian(cx, cy, r, end);
    const e = polarToCartesian(cx, cy, r, start);
    const largeArc = end - start <= 180 ? 0 : 1;
    return `M ${s.x} ${s.y} A ${r} ${r} 0 ${largeArc} 0 ${e.x} ${e.y}`;
  }

  let startAngle = 0;
  const gap = 9;
  function polar(cx, cy, r, angle) {
    const rad = (angle - 90) * Math.PI / 180;
    return { x: cx + r * Math.cos(rad), y: cy + r * Math.sin(rad) };
  }

  segmentsData.forEach(seg => {
    const arcAngle = (seg.value / 100) * 360;
    const endAngle = startAngle + arcAngle;
    const midAngle = (startAngle + endAngle) / 2;

    const path = document.createElementNS('http://www.w3.org/2000/svg', 'path');
    path.setAttribute('d', describeArc(50, 50, 45, startAngle + gap, endAngle - gap));
    path.setAttribute('stroke', seg.color);
    path.setAttribute('stroke-width', '10');
    path.setAttribute('fill', 'none');
    path.setAttribute('stroke-linecap', 'round');
    path.style.opacity = 0.6;
    path.style.transition = 'all 0.4s';

    const offset = polar(0, 0, 10, midAngle);

    path.addEventListener('mouseenter', () => {
      path.style.opacity = 1;
      const pos = polar(50, 50, 62, midAngle);
      percentualExterno.setAttribute('x', pos.x);
      percentualExterno.setAttribute('y', pos.y);
      percentualExterno.textContent = `${Math.round(seg.value)}%`;
      percentualExterno.style.opacity = 1;
    });

    path.addEventListener('mouseleave', () => {
      path.style.opacity = 0.6;
      percentualExterno.style.opacity = 0;
    });

    path.addEventListener('click', () => {
      path.setAttribute('transform', `translate(${offset.x},${offset.y})`);
      setTimeout(() => {
        path.setAttribute('transform', 'translate(0,0)');
      }, 2500);
    });

    segmentsGroup.appendChild(path);
    startAngle = endAngle;
  });

  percentualCentral.textContent = `${Math.round(percReceitas)}%`;
  centro.setAttribute('fill', document.documentElement.classList.contains('dark') ? '#1F2937' : '#ffffff');


  /* =====================
     DADOS GRÁFICO DE BARRAS
  ===================== */
  const dados = [
    { dia: 'Seg', altura: 40, valor: '42' },
    { dia: 'Ter', altura: 60, valor: '68' },
    { dia: 'Qua', altura: 54, valor: '55' },
    { dia: 'Qui', altura: 76, valor: '82' },
    { dia: 'Sex', altura: 93, valor: '10%' },
    { dia: 'Sab', altura: 80, valor: '84' },
    { dia: 'Dom', altura: 34, valor: '58' },
  ];

  const insightCard = [...document.querySelectorAll('h3')]
    .find(h => h.textContent.trim() === 'Insights')
    ?.closest('.bg-white, .dark\\:bg-\\[\\#151517\\]');

  if (!insightCard) return;

  const graficoAntigo = insightCard.querySelector('.flex.justify-between.items-end');
  if (!graficoAntigo) return;

  graficoAntigo.innerHTML = '';
  graficoAntigo.classList.add('relative');
  graficoAntigo.style.height = '100px';

  dados.forEach((dado, i) => {
    const col = document.createElement('div');
    col.className = 'relative flex flex-col items-center justify-end h-full w-8';

    const dia = document.createElement('div');
    dia.textContent = dado.dia;
    dia.className = 'absolute -bottom-6 text-xs text-gray-500 dark:text-gray-400';

    const bolinha = document.createElement('div');
    bolinha.className = 'absolute rounded-full';
    bolinha.style.width = '14px';
    bolinha.style.height = '14px';
    bolinha.style.bottom = '15px';
    bolinha.style.left = '50%';
    bolinha.style.transform = 'translateX(-50%)';
    bolinha.style.zIndex = '10';

    const barra = document.createElement('div');
    barra.className = 'absolute rounded';
    barra.style.width = '10px';
    barra.style.height = '0';
    barra.style.bottom = '36px';
    barra.style.left = '50%';
    barra.style.transform = 'translateX(-50%)';
    barra.style.transition = 'height .5s ease';

    const valor = document.createElement('div');
    valor.textContent = dado.valor;
    valor.className = 'absolute text-xs font-semibold';
    valor.style.opacity = '0';
    valor.style.transition = 'all .4s ease';
    valor.style.left = '50%';
    valor.style.transform = 'translateX(-50%)';

    if (i === 4) {
      bolinha.classList.add('bg-blue-600', 'dark:bg-blue-400');
      barra.classList.add('bg-blue-600');
      valor.classList.add('text-blue-600', 'dark:text-blue-400');
    } else {
      bolinha.classList.add('bg-gray-800', 'dark:bg-gray-400');
      barra.classList.add('bg-gray-800', 'dark:bg-gray-400');
      valor.classList.add('text-gray-900', 'dark:text-white');
    }

    col.appendChild(dia);
    col.appendChild(bolinha);
    col.appendChild(barra);
    col.appendChild(valor);
    graficoAntigo.appendChild(col);

    setTimeout(() => {
      barra.style.height = `${dado.altura}px`;
      valor.style.bottom = `${33 + dado.altura + 6}px`;
      valor.style.opacity = '1';
    }, i * 120);
  });

});
