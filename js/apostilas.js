// Dados das apostilas organizados por nível e ano
const dadosApostilas = {
  fundamental1: {
    titulo: 'Ensino Fundamental I',
    anos: {
      '1º ano': {
        disciplinas: {
          'Português': [
            { titulo: 'Introdução às Letras', url: '' },
            { titulo: 'Vogais e Consoantes', url: 'https://www.educacao.pr.gov.br/sites/default/arquivos_restritos/files/documento/2021-02/educa_juntos_coletanea_atividades_aluno_1ano.pdf' },
            { titulo: 'Primeiras Palavras', url: 'pdfs/fundamental1/1ano/portugues/primeiras-palavras.pdf' }
          ],
          'Matemática': [
            { titulo: 'Números de 0 a 10', url: 'pdfs/fundamental1/1ano/matematica/numeros-0-10.pdf' },
            { titulo: 'Adição Simples', url: 'pdfs/fundamental1/1ano/matematica/adicao-simples.pdf' },
            { titulo: 'Subtração Básica', url: 'pdfs/fundamental1/1ano/matematica/subtracao-basica.pdf' }
          ],
          'Ciências': [
            { titulo: 'Animais e Plantas', url: 'pdfs/fundamental1/1ano/ciencias/animais-plantas.pdf' },
            { titulo: 'Corpo Humano', url: 'pdfs/fundamental1/1ano/ciencias/corpo-humano.pdf' },
            { titulo: 'Estações do Ano', url: 'pdfs/fundamental1/1ano/ciencias/estacoes-ano.pdf' }
          ]
        }
      },
      '2º ano': {
        disciplinas: {
          'Português': [
            { titulo: 'Leitura e Escrita', url: 'pdfs/fundamental1/2ano/portugues/leitura-escrita.pdf' },
            { titulo: 'Sílabas', url: 'pdfs/fundamental1/2ano/portugues/silabas.pdf' }
          ],
          'Matemática': [
            { titulo: 'Números até 100', url: 'pdfs/fundamental1/2ano/matematica/numeros-100.pdf' },
            { titulo: 'Multiplicação Introdução', url: 'pdfs/fundamental1/2ano/matematica/multiplicacao-intro.pdf' }
          ],
          'Ciências': [
            { titulo: 'Seres Vivos', url: 'pdfs/fundamental1/2ano/ciencias/seres-vivos.pdf' }
          ],
          'História': [
            { titulo: 'História da Família', url: 'pdfs/fundamental1/2ano/historia/historia-familia.pdf' }
          ]
        }
      },
      '3º ano': {
        disciplinas: {
          'Português': [
            { titulo: 'Separação de Sílabas', url: 'pdfs/fundamental1/3ano/portugues/separacao-silabas.pdf' },
            { titulo: 'Pontuação Básica', url: 'pdfs/fundamental1/3ano/portugues/pontuacao-basica.pdf' }
          ],
          'Matemática': [
            { titulo: 'Multiplicação', url: 'pdfs/fundamental1/3ano/matematica/multiplicacao.pdf' },
            { titulo: 'Divisão Simples', url: 'pdfs/fundamental1/3ano/matematica/divisao-simples.pdf' }
          ],
          'Ciências': [
            { titulo: 'Habitat e Nicho', url: 'pdfs/fundamental1/3ano/ciencias/habitat-nicho.pdf' }
          ],
          'Geografia': [
            { titulo: 'Mapa do Brasil', url: 'pdfs/fundamental1/3ano/geografia/mapa-brasil.pdf' }
          ]
        }
      },
      '4º ano': {
        disciplinas: {
          'Português': [
            { titulo: 'Análise de Textos', url: 'pdfs/fundamental1/4ano/portugues/analise-textos.pdf' },
            { titulo: 'Concordância Verbal', url: 'pdfs/fundamental1/4ano/portugues/concordancia-verbal.pdf' }
          ],
          'Matemática': [
            { titulo: 'Frações Básicas', url: 'pdfs/fundamental1/4ano/matematica/fracoes-basicas.pdf' },
            { titulo: 'Números Decimais', url: 'pdfs/fundamental1/4ano/matematica/numeros-decimais.pdf' }
          ],
          'Ciências': [
            { titulo: 'Sistema Solar', url: 'pdfs/fundamental1/4ano/ciencias/sistema-solar.pdf' }
          ],
          'Geografia': [
            { titulo: 'Regiões do Brasil', url: 'pdfs/fundamental1/4ano/geografia/regioes-brasil.pdf' }
          ]
        }
      },
      '5º ano': {
        disciplinas: {
          'Português': [
            { titulo: 'Gêneros Textuais', url: 'pdfs/fundamental1/5ano/portugues/generos-textuais.pdf' },
            { titulo: 'Interpretação de Textos', url: 'pdfs/fundamental1/5ano/portugues/interpretacao-textos.pdf' }
          ],
          'Matemática': [
            { titulo: 'Operações com Decimais', url: 'pdfs/fundamental1/5ano/matematica/operacoes-decimais.pdf' },
            { titulo: 'Geometria Básica', url: 'pdfs/fundamental1/5ano/matematica/geometria-basica.pdf' }
          ],
          'Ciências': [
            { titulo: 'Mudanças Climáticas', url: 'pdfs/fundamental1/5ano/ciencias/mudancas-climaticas.pdf' }
          ],
          'Geografia': [
            { titulo: 'Continentes e Oceanos', url: 'pdfs/fundamental1/5ano/geografia/continentes-oceanos.pdf' }
          ]
        }
      }
    }
  },
  fundamental2: {
    titulo: 'Ensino Fundamental II',
    anos: {
      '6º ano': {
        disciplinas: {
          'Português': [
            { titulo: 'Morfologia: Classes de Palavras', url: 'pdfs/fundamental2/6ano/portugues/morfologia.pdf' }
          ],
          'Matemática': [
            { titulo: 'Potenciação', url: 'pdfs/fundamental2/6ano/matematica/potenciacao.pdf' },
            { titulo: 'Raiz Quadrada', url: 'pdfs/fundamental2/6ano/matematica/raiz-quadrada.pdf' }
          ],
          'Ciências': [
            { titulo: 'Célula e Vida', url: 'pdfs/fundamental2/6ano/ciencias/celula-vida.pdf' }
          ],
          'História': [
            { titulo: 'Pré-História Brasileira', url: 'pdfs/fundamental2/6ano/historia/pre-historia.pdf' }
          ],
          'Geografia': [
            { titulo: 'Cartografia', url: 'pdfs/fundamental2/6ano/geografia/cartografia.pdf' }
          ],
          'Inglês': [
            { titulo: 'Present Simple', url: 'pdfs/fundamental2/6ano/ingles/present-simple.pdf' }
          ]
        }
      },
      '7º ano': {
        disciplinas: {
          'Português': [
            { titulo: 'Sintaxe da Oração', url: 'pdfs/fundamental2/7ano/portugues/sintaxe-oracao.pdf' }
          ],
          'Matemática': [
            { titulo: 'Expressões Algébricas', url: 'pdfs/fundamental2/7ano/matematica/expressoes-algebraicas.pdf' }
          ],
          'Ciências': [
            { titulo: 'Sistema Nervoso', url: 'pdfs/fundamental2/7ano/ciencias/sistema-nervoso.pdf' }
          ],
          'História': [
            { titulo: 'Brasil Colonial', url: 'pdfs/fundamental2/7ano/historia/brasil-colonial.pdf' }
          ],
          'Geografia': [
            { titulo: 'Clima e Vegetação', url: 'pdfs/fundamental2/7ano/geografia/clima-vegetacao.pdf' }
          ],
          'Inglês': [
            { titulo: 'Present Continuous', url: 'pdfs/fundamental2/7ano/ingles/present-continuous.pdf' }
          ]
        }
      },
      '8º ano': {
        disciplinas: {
          'Português': [
            { titulo: 'Análise Sintática Completa', url: 'pdfs/fundamental2/8ano/portugues/analise-sintatica.pdf' }
          ],
          'Matemática': [
            { titulo: 'Equações do 1º Grau', url: 'pdfs/fundamental2/8ano/matematica/equacoes-1grau.pdf' }
          ],
          'Ciências': [
            { titulo: 'Reprodução Humana', url: 'pdfs/fundamental2/8ano/ciencias/reproducao-humana.pdf' }
          ],
          'História': [
            { titulo: 'Independência do Brasil', url: 'pdfs/fundamental2/8ano/historia/independencia.pdf' }
          ],
          'Geografia': [
            { titulo: 'População Brasileira', url: 'pdfs/fundamental2/8ano/geografia/populacao-brasileira.pdf' }
          ],
          'Inglês': [
            { titulo: 'Past Simple', url: 'pdfs/fundamental2/8ano/ingles/past-simple.pdf' }
          ]
        }
      },
      '9º ano': {
        disciplinas: {
          'Português': [
            { titulo: 'Sintaxe do Período Composto', url: 'pdfs/fundamental2/9ano/portugues/periodo-composto.pdf' }
          ],
          'Matemática': [
            { titulo: 'Equações do 2º Grau', url: 'pdfs/fundamental2/9ano/matematica/equacoes-2grau.pdf' }
          ],
          'Ciências': [
            { titulo: 'Evolução e Seleção Natural', url: 'pdfs/fundamental2/9ano/ciencias/evolucao-selecao.pdf' }
          ],
          'História': [
            { titulo: 'República Velha', url: 'pdfs/fundamental2/9ano/historia/republica-velha.pdf' }
          ],
          'Geografia': [
            { titulo: 'Economia Brasileira', url: 'pdfs/fundamental2/9ano/geografia/economia-brasileira.pdf' }
          ],
          'Inglês': [
            { titulo: 'Present Perfect', url: 'pdfs/fundamental2/9ano/ingles/present-perfect.pdf' }
          ]
        }
      }
    }
  },
  medio: {
    titulo: 'Ensino Médio',
    anos: {
      '1º ano': {
        disciplinas: {
          'Português': [
            { titulo: 'Literatura Portuguesa', url: 'pdfs/medio/1ano/portugues/literatura-portuguesa.pdf' }
          ],
          'Matemática': [
            { titulo: 'Funções Quadráticas', url: 'pdfs/medio/1ano/matematica/funcoes-quadraticas.pdf' }
          ],
          'Ciências': [
            { titulo: 'Química Geral', url: 'pdfs/medio/1ano/ciencias/quimica-geral.pdf' }
          ],
          'História': [
            { titulo: 'Idade Moderna', url: 'pdfs/medio/1ano/historia/idade-moderna.pdf' }
          ],
          'Geografia': [
            { titulo: 'Geopolítica', url: 'pdfs/medio/1ano/geografia/geopolitica.pdf' }
          ],
          'Inglês': [
            { titulo: 'Future Tense', url: 'pdfs/medio/1ano/ingles/future-tense.pdf' }
          ]
        }
      },
      '2º ano': {
        disciplinas: {
          'Português': [
            { titulo: 'Literatura Brasileira Colonial', url: 'pdfs/medio/2ano/portugues/literatura-colonial.pdf' }
          ],
          'Matemática': [
            { titulo: 'Trigonometria', url: 'pdfs/medio/2ano/matematica/trigonometria.pdf' }
          ],
          'Ciências': [
            { titulo: 'Física Clássica', url: 'pdfs/medio/2ano/ciencias/fisica-classica.pdf' }
          ],
          'História': [
            { titulo: 'Iluminismo', url: 'pdfs/medio/2ano/historia/iluminismo.pdf' }
          ],
          'Geografia': [
            { titulo: 'Sustentabilidade Global', url: 'pdfs/medio/2ano/geografia/sustentabilidade.pdf' }
          ],
          'Inglês': [
            { titulo: 'Conditional Structures', url: 'pdfs/medio/2ano/ingles/conditional.pdf' }
          ]
        }
      },
      '3º ano': {
        disciplinas: {
          'Português': [
            { titulo: 'Literatura Brasileira Moderna', url: 'pdfs/medio/3ano/portugues/literatura-moderna.pdf' }
          ],
          'Matemática': [
            { titulo: 'Geometria Analítica', url: 'pdfs/medio/3ano/matematica/geometria-analitica.pdf' }
          ],
          'Ciências': [
            { titulo: 'Biologia Molecular', url: 'pdfs/medio/3ano/ciencias/biologia-molecular.pdf' }
          ],
          'História': [
            { titulo: 'História Contemporânea', url: 'pdfs/medio/3ano/historia/historia-contemporanea.pdf' }
          ],
          'Geografia': [
            { titulo: 'Brasil no Século XXI', url: 'pdfs/medio/3ano/geografia/brasil-seculo-xxi.pdf' }
          ],
          'Inglês': [
            { titulo: 'Advanced Reading', url: 'pdfs/medio/3ano/ingles/advanced-reading.pdf' }
          ]
        }
      }
    }
  }
};

// Ícones para as disciplinas
const iconosDisciplinas = {
  'Português': '📝',
  'Matemática': '🔢',
  'Ciências': '🔬',
  'História': '📖',
  'Geografia': '🌍',
  'Inglês': '🌐'
};

// Elementos do DOM
const nivelButtons = document.querySelectorAll('.nivel-btn');
const anosSection = document.getElementById('anos-section');
const anosContainer = document.getElementById('anos-container');
const disciplinasSection = document.getElementById('disciplinas-section');
const disciplinasGrid = document.getElementById('disciplinas-grid');
const tituloDisciplinas = document.getElementById('titulo-disciplinas');
const modalPdf = document.getElementById('modal-pdf');
const modalClose = document.getElementById('modal-close');
const pdfIframe = document.getElementById('pdf-iframe');

let nivelSelecionado = null;
let anoSelecionado = null;

// Event listeners para os botões de nível
nivelButtons.forEach(btn => {
  btn.addEventListener('click', () => {
    // Remove classe ativa dos botões de nível
    nivelButtons.forEach(b => b.classList.remove('active'));
    btn.classList.add('active');

    nivelSelecionado = btn.getAttribute('data-nivel');
    anoSelecionado = null;

    // Mostra seção de anos
    anosSection.style.display = 'block';
    disciplinasSection.style.display = 'none';

    // Preenche os anos
    preencherAnos();

    // Scroll para a seção de anos
    setTimeout(() => {
      anosSection.scrollIntoView({ behavior: 'smooth', block: 'start' });
    }, 100);
  });
});

// Preenche os botões de anos
function preencherAnos() {
  anosContainer.innerHTML = '';
  const dados = dadosApostilas[nivelSelecionado];
  
  Object.keys(dados.anos).forEach(ano => {
    const btn = document.createElement('button');
    btn.className = 'ano-btn';
    btn.textContent = ano;
    btn.addEventListener('click', () => {
      selecionarAno(ano, btn);
    });
    anosContainer.appendChild(btn);
  });
}

// Seleciona um ano e exibe as disciplinas
function selecionarAno(ano, btnElement) {
  // Remove classe ativa dos botões de ano
  document.querySelectorAll('.ano-btn').forEach(b => b.classList.remove('active'));
  btnElement.classList.add('active');

  anoSelecionado = ano;

  // Mostra seção de disciplinas
  disciplinasSection.style.display = 'block';

  const dados = dadosApostilas[nivelSelecionado].anos[ano];
  tituloDisciplinas.textContent = `${dadosApostilas[nivelSelecionado].titulo} - ${ano}`;

  // Preenche as disciplinas
  preencherDisciplinas(dados.disciplinas);

  // Scroll para a seção de disciplinas
  setTimeout(() => {
    disciplinasSection.scrollIntoView({ behavior: 'smooth', block: 'start' });
  }, 100);
}

// Preenche o grid de disciplinas
function preencherDisciplinas(disciplinas) {
  disciplinasGrid.innerHTML = '';

  Object.keys(disciplinas).forEach(nomeDisciplina => {
    const apostilas = disciplinas[nomeDisciplina];
    const icone = iconosDisciplinas[nomeDisciplina] || '📚';

    const card = document.createElement('div');
    card.className = 'disciplina-card';

    const header = document.createElement('div');
    header.className = 'disciplina-header';
    header.innerHTML = `
      <span class="disciplina-icon">${icone}</span>
      <h3>${nomeDisciplina}</h3>
    `;

    const body = document.createElement('div');
    body.className = 'disciplina-body';

    const lista = document.createElement('ul');
    lista.className = 'apostila-list';

    apostilas.forEach(apostila => {
      const item = document.createElement('li');
      item.className = 'apostila-item';
      item.innerHTML = `
        <p class="apostila-title">${apostila.titulo}</p>
        <div class="apostila-buttons">
          <button class="apostila-btn btn-visualizar" onclick="visualizarPDF('${apostila.url}')">
            <i class="fas fa-eye"></i> Visualizar
          </button>
          <button class="apostila-btn btn-download" onclick="downloadPDF('${apostila.url}', '${apostila.titulo}')">
            <i class="fas fa-download"></i> Download
          </button>
        </div>
      `;
      lista.appendChild(item);
    });

    body.appendChild(lista);
    card.appendChild(header);
    card.appendChild(body);
    disciplinasGrid.appendChild(card);
  });
}

// Visualiza o PDF no modal
function visualizarPDF(url) {
  pdfIframe.src = url;
  modalPdf.style.display = 'flex';
  document.body.style.overflow = 'hidden';
}

// Fecha o modal
modalClose.addEventListener('click', () => {
  modalPdf.style.display = 'none';
  pdfIframe.src = '';
  document.body.style.overflow = 'auto';
});

// Fecha o modal ao clicar fora do conteúdo
modalPdf.addEventListener('click', (e) => {
  if (e.target === modalPdf) {
    modalPdf.style.display = 'none';
    pdfIframe.src = '';
    document.body.style.overflow = 'auto';
  }
});

// Download do PDF
function downloadPDF(url, titulo) {
  // Cria um elemento 'a' temporário para fazer o download
  const link = document.createElement('a');
  link.href = url;
  link.download = `${titulo}.pdf`;
  document.body.appendChild(link);
  link.click();
  document.body.removeChild(link);
}
