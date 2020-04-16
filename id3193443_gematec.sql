-- phpMyAdmin SQL Dump
-- version 4.9.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Tempo de geração: 12-Fev-2020 às 07:49
-- Versão do servidor: 10.3.16-MariaDB
-- versão do PHP: 7.3.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `id3193443_gematec`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `apresentacoes`
--

CREATE TABLE `apresentacoes` (
  `id` int(11) NOT NULL,
  `titulo` varchar(100) NOT NULL,
  `autor` varchar(100) NOT NULL,
  `ano` year(4) NOT NULL,
  `palavras_chave` varchar(100) NOT NULL,
  `apresentacao` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `apresentacoes`
--

INSERT INTO `apresentacoes` (`id`, `titulo`, `autor`, `ano`, `palavras_chave`, `apresentacao`) VALUES
(19, 'Apresentação do Sistema de Gerenciamento e Controle - GEMATEC', 'FONSECA,R.B.C.; DINIZ,M.C.S.', 2018, 'Inexistente', '49170e957b1fbcdda74d6cf69cc6ab6b.pdf');

-- --------------------------------------------------------

--
-- Estrutura da tabela `arquivos`
--

CREATE TABLE `arquivos` (
  `id` int(11) NOT NULL,
  `titulo` varchar(100) NOT NULL,
  `tipo` varchar(50) NOT NULL,
  `autor` varchar(100) NOT NULL,
  `palavras_chave` varchar(100) NOT NULL,
  `ano` year(4) NOT NULL,
  `arquivo` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `convites`
--

CREATE TABLE `convites` (
  `id` int(11) NOT NULL,
  `dia` int(11) NOT NULL,
  `mes` int(11) NOT NULL,
  `ano` int(11) NOT NULL,
  `convite` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `genero`
--

CREATE TABLE `genero` (
  `id` int(11) NOT NULL,
  `genero` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `genero`
--

INSERT INTO `genero` (`id`, `genero`) VALUES
(12, 'Informativó');

-- --------------------------------------------------------

--
-- Estrutura da tabela `livros`
--

CREATE TABLE `livros` (
  `id` int(11) NOT NULL,
  `titulo` varchar(100) NOT NULL,
  `genero` varchar(100) NOT NULL,
  `autor` varchar(100) NOT NULL,
  `editora` varchar(100) NOT NULL,
  `ano` year(4) NOT NULL,
  `livro` varchar(100) NOT NULL,
  `capa` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `livros`
--

INSERT INTO `livros` (`id`, `titulo`, `genero`, `autor`, `editora`, `ano`, `livro`, `capa`) VALUES
(38, 'Testé', 'Informativó', 'bananá', 'testá', 2019, '', '3537361203d5119e95ccab3ff0563830.jpg');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tipo`
--

CREATE TABLE `tipo` (
  `id` int(11) NOT NULL,
  `tipo` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `tipo`
--

INSERT INTO `tipo` (`id`, `tipo`) VALUES
(10, 'Testé');

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuario`
--

CREATE TABLE `usuario` (
  `id_user` int(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  `senha` varchar(50) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `usuario`
--

INSERT INTO `usuario` (`id_user`, `email`, `senha`) VALUES
(1, 'gematec@email.com', 'gematec');

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `autor` varchar(10000) NOT NULL,
  `titulo` varchar(10000) NOT NULL,
  `palavras_chave` varchar(1000) NOT NULL,
  `ano` int(11) NOT NULL,
  `banner` varchar(100) NOT NULL,
  `thumb` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `usuarios`
--

INSERT INTO `usuarios` (`id`, `autor`, `titulo`, `palavras_chave`, `ano`, `banner`, `thumb`) VALUES
(174, 'RESENDE,Valim Liliam; NAGEM,Ronaldo Luiz; FONSECA,Maia o Carmo.', 'Metáforas da gravidez na adolescência na perspectiva da educação em saúde sexual e reprodutiva', '______', 0, 'c5674c9c26a568b7732e01e032d5b8b4.jpg', 'bef20776b415032b91de74fa491a0d1b.jpg'),
(175, 'MELO,Maria Fernanda;NAGEM,Ronaldo Luiz;RABELO,Anderson Arthur', 'O ensino de ciências e as metáforas: Um panorama das publicações científicas no Brasil.', '______', 0, 'afa0d902a4e74ffdb7d5340fc4e0d940.jpg', 'a025daf847d2094a2f524e1737451e5f.jpg'),
(173, 'FONSECA, Elian C.Silva; NAGEM, Ronaldo Luiz', 'A utilização de modelos,analogias e metáforas na construção de conhecimentos significativos à luz da teoria de Vygotsky', '______', 0, '8eaa4a2bcb1c1f8a9a58e5fa73e9b819.jpg', '9a06750a41baf1a07e2c695a9f23bd33.jpg'),
(180, 'NAGEM,Ronado;ASSIS,Ricardo', 'O uso de metáforas em slogans publicitários e seu papel na formação da imagem institucional de duas instituições de ensino superior de Belo Horizonte', '______', 0, 'b8be4c1ab613d013a80391e3f7ef3634.jpg', 'a0a8aad2d5532a8ce6739d65f12e8730.jpg'),
(182, 'ALVARENGA,Gilson Rodrigues de', 'Domínios e propósitos de comparações em livros didáticos de química', '______', 0, '9fbcd98a9dd8926388a3bc3f01185196.jpg', '16b09508ddba65ac695e3dfc2f64a093.jpg'),
(183, 'MOREIRA, Lídia Alves', 'Animação cinematográfica como recurso didático na prevenção ao uso de drogas', '______', 0, 'de01790061439a3c957d732f32275b86.jpg', '8f0ac983fed19634764840c75a90bdc6.jpg'),
(184, 'COELO,Marcos Antonio;MARCELOS,Mariade Fátima;SÁ BARRETO,Ranylsonde,Neto', 'As metáforas como facilitadoras da aprendizagem de ciências contábeis,segundo formandos', '______', 0, 'e92b4b7525c3cb77256437eef73fee7e.jpg', '876fd79f98d7700282c5188b28961641.jpg'),
(185, 'ALVARENGA,Gilson Rodrigues; VIEIRA,Mariana; FERRY,Alexandre da Silva', 'Mapeamento estrutural de uma analogia para o modelo atômico de Rutherford presente em livros didáticos de química', 'Livro didático,Analogias,mapeamento estrutural ,modelo atômico', 2015, 'ad099cdb4f20dbd4f9af30575c5eebe4.jpg', 'f4aaae2abe1bc9a8081fe29b2a949447.jpg'),
(186, 'AFONSO, Luara Zucolotto; NAGEM, Ronaldo Luiz; GINO, Maúricio Silva', 'As máquinas de voo de Leonardo da Vinci: Um olhar sobre as analogias biônicas e suas potencialidades no processo criativo', '______', 0, '78c6f8a62089515a51b4dea05a27cd8f.jpg', '11819013f08d25d571cd343a1ee57635.jpg'),
(187, 'FERREIRA,Emanuele B.Marques; NAGEM,Ronaldo Luiz', 'Um encontro de muitas vozes: História e memória de um grupo de estudo multidisciplinar', '______', 0, '9fcf28caa2802ac970330632f2776ec4.jpg', '3cbd038353230e951bafd93c816d7b7d.jpg'),
(188, 'COUTO,Pablo Alves;NAGEM,Ronaldo Luiz', 'Modelo de natureza e meio ambiente presentes em artigos científicos de diferentes contextos', '______', 0, '9f3cad2fd3740b5a1142250ec0b52227.jpg', 'ba515a1ed6c4cb68c909a38943ac0c82.jpg'),
(191, 'NAGEM,Ronaldo Luiz; GINO,Andre Silva;GINO,Mauricio Silva', 'Conhecimento: Relação entre subjetividade,analogias,metáforas e autoria', '______', 0, '30fae7016cdfde45d31570e4ffcbc911.jpg', 'a3c0d02eeef0ebdaa7d2df22866a53f8.jpg'),
(190, 'BARBOSA, Wilbert Viana; FERRY, Alexandre da Silva', 'A tabula rasa de Locke e o HD: um estudo sobre as similaridades, as diferenças e as limitações dessa analogia', '______', 0, '8420773aa340b6b6417b91e189a0c999.jpg', '722e410cb4a86c824f88db8d1ac4d18f.jpg'),
(192, 'GONÇALVES,Vanilda Maria', 'Um estudo sobre a presença de analogias e metáforas no processo de ensino e de aprendizagem em um ambiente de informática e da educação infantil', '______', 0, '54a4ce0b143045ca2842e37c171d9c64.jpg', 'eba9e2541d6c734a1a479bfb090343b4.jpg'),
(193, 'FERREIRA,Helton Luiz Dias;FERRY,Alexandre da Silva', 'Domínios base e alvo de analogias e outros tipos de comparação sobre reações em equilíbrio químico presentes em livros didáticos', '______', 0, '0ce9810cdbb34aba972f3095ff39a797.jpg', '1b68badb0594e5c2fccd8e97f67f4d20.jpg'),
(194, 'FREITAS, Luiza Izabel de', '\"Nossas estrelas não têm pontas\" - Modelo analógico do espaço sideral tridimensional em meio fluido', '______', 0, '42f630e5e381ef31c3bfce022fec0ffc.jpg', '90aefe7c40e8c1e6ade8eb41a8bcab45.jpg'),
(198, 'AMARAL,Silvia Eugênia do;NAGEM,Ronaldo Luiz', 'Uso de metáforas em campanhas de prevenção da AIDS', '______', 0, '1973853094e64024c08422fabde3f46f.jpg', 'f6941b7ccde5401f1c8edc5ea9e6b821.jpg'),
(199, 'BADARÓ, Carolina; LEROY, Fernanda; RAMOS, Ivo de Jesus', 'Análise de conceitos de metáforas', '______', 0, '6d4a415e8cbbe70a2e3572c506d2577a.jpg', '1ee3fece356682c8abbd2d40a6cf4656.jpg'),
(200, 'NAGEM,Ronaldo Luiz;RESENDE,Lilian Valim', 'Concepções metafóricas sobre a gravidez na adolescência', '______', 0, '6078679daa30ead79f251fae3e76da1b.jpg', 'eb05d299126cc5d3c54c283782103e21.jpg'),
(203, 'DE BARROS MORREIRA ,Rafael Campbell', 'Índice AMTEC Vol.3', '______', 0, '2c0d716c4de6c9fddad725e9187db589.jpg', '61a151f578f23778602b7620fbd5457f.jpg'),
(205, 'EWALDO M.Carvalho;NAGEM,Ronaldo Luiz', 'The group for the study of metaphors and analogies in technology,education,science and art', '______', 0, 'fc5fca13719e6cd3136b595bae5d4caa.jpg', '9e7dbbae1cbbafe8df922588157626ab.jpg'),
(206, '______', 'Foto multiverso 1', '______', 0, '1f74b976727349e0d525324638dc3d1d.jpg', '59f3c9b87857d90ebb71d911e7f94d8d.jpg'),
(207, '______', 'Foto multiverso 2', '______', 0, '1693de212d51ba568da5ca8e1d4bc70e.jpg', '370b85d47312ed15876ae749f63f8319.jpg'),
(208, '______', 'Foto multiverso 3', '______', 0, '2c6c5df9938dad578a077a5470229520.jpg', '66a18b4a923f1ff32081e318ce5d0ba0.jpg'),
(209, '______', 'Foto multiverso 4', '______', 0, 'bbaff3499b71aabdb2a2a96e8d24c597.jpg', '441dbbbbbb63d5ccf7c2d841bee9e9df.jpg'),
(210, '______', 'Foto multiverso 5', '______', 0, 'e37cbe94554f45f09c584069d343daa4.jpg', '27ac7ebded63ec32d8ff48af4321428c.jpg'),
(211, '______', 'Foto multiverso 6', '______', 0, '3a774c82e6d6fe2947977bdd1eb83b14.jpg', 'e656ac9969b76c38f5a45c69804ae2b3.jpg'),
(212, '______', 'Foto multiverso 7', '______', 0, '65ae1556f30715030f716da6b6fc8df7.jpg', '2725c035fb2dc20c5f0de30b646d8646.jpg'),
(213, '______', 'Foto multiverso 8', '______', 0, '53fb8dd9e6555b96c7c34cc487d90635.jpg', '046e7540c56a9a526dabc79c76a82270.jpg'),
(214, '______', 'Foto multiverso 9', '______', 0, '5fa9f77b29bda6efb2be3f544b1be9db.jpg', 'be6aad79bbab484a29322bdb9dfd7706.jpg'),
(217, 'FERRY, Alexandre da Silva; NAGEM, Ronaldo Luiz', 'Analogias e contra-analogias no processo de ensino e aprendizagem de modelos atômicos', '______', 0, '1e65ba284682e9b3e706e14c45029c89.jpg', 'aca12420e3d2ab34745d4ba3c4589d12.jpg'),
(218, 'OLIVEIRA,Alexsandro J.F.;NAGEM,Ronaldo Luiz', 'Uso de modelo de ensino em ciências com recurso a analogias – o planetário líquido em três dimensões', '______', 0, '6cdb425426451dc8184fce4be08ab126.jpg', 'a9ff2e9b74be5eef58d6d63eab961fc7.jpg'),
(219, 'AMARAL,Silvia Eugênia Do; NAGEM,Ronaldo Luiz', 'O uso de metáforas em campanhas de prevenção da AIDS ', '______', 0, 'b1b476848c9fd6d0683d4edd663956c3.jpg', '93169f84a8863b1410c480a2d87135a3.jpg'),
(222, '______', 'Análise de uma prática de ensino, por meio de uma analogia, para alunos de 7 a 8 anos de idade.', ' ASSIS, Priscila Aparecida Mariano de; NAGEM, Ronaldo Luiz', 0, '75be5bed51aa5fea7319adeb66626d32.jpg', '875985f735b6b5c0503b84294c0bb6cd.jpg'),
(223, 'NAGEM,Ronaldo Luiz; BARBOSA,Catia R; MARCELOS,Maria de F; FIGUEROA,Ana M.S; FERRY,Alexandre da S; DELFINO,Douglas G', 'Rede internacional de pesquisa e analogias e metáforas na tecnologia, na educação, na ciência e na arte', '______', 0, '6ad7d411b6356c204a2a1fc1c6f99dce.jpg', 'd545826490ea0264a1daad2c44a02d2b.jpg'),
(224, 'DE BARROS MOREIRA ,Rafael Campbell', 'Índice AMTEC', '______', 0, '670d7cf22789a6771f7722d3c4f10136.jpg', '43526aeefaa3c7cbfcb57e759a29abbb.jpg'),
(225, 'NAGEM,Ronaldo Luiz; SANTOS,Eliane Diniz', 'O uso das analogias como uma nova proposta de ensino para os profissionais de saúde: Máquina de hemodiálise e o rim  ', '______', 0, 'fbd5baec39fd871aa8eaf33752e70365.jpg', 'a31c0ae15392a27232e33405f9056a97.jpg'),
(228, 'FERRY, Alexandre da Silva; NAGEM, Ronaldo Luiz', 'Análise da apresentação do modelo atômico de Thomson em livros didáticos:Analogia com um \"pudim de passas\"', '______', 0, '4e81157058e570aae7fcfaeecdb0c59f.jpg', '787173c2b0081c94e731201304b374f7.jpg'),
(229, 'PEREIRA,Ana Cristina C;CARVALHO,Ewaldo M;NAGEM,Ronaldo Luiz', 'Uso de analogias e metáforas no ensino da dança clássica', '______', 0, '659512e785c873813fd8a36b5009b7c4.jpg', '11aa4074a075a37cb80fa3e17bc1a9e7.jpg'),
(230, 'OLIVEIRA, Eliane Freire de', 'Analogias e metáforas como recursos didáticos no ensino da matemática', '______', 0, '8d6727921158ca7b6150201f3bd9902e.jpg', '97da83be4ab21375256da22ff05377c7.jpg'),
(231, 'GONÇALVES,Vanilda Maria;NAGEM,Ronaldo Luiz', 'O pensamento analógico no entendimento e na geração de novas ideias/conceitos', '______', 0, 'ae7c33669608589c40a38719b98f6482.jpg', 'e617828632280edf6f26fae2c910008f.jpg'),
(232, 'NAGEM, Ronaldo Luiz; AMARAL, Silvia Eugênia; SANTOS, Elândia dos; SILVA, Eliana Aparecida Ferreira da; SANTOS, Elizângela dos; VELOSO, Eloísa Maria Clarete; LUZ, Maria de Fátima da; ALMEIDA, Vladimir Lourenço de', 'A recepção por mulheres negras das campanhas institucionalizadas de saúde sexual e reprodutiva', '______', 2005, '92693e6cd9690126d625afc2871dccd1.jpg', '399cb53da8ed9e811439bf41d7511db2.jpg'),
(233, 'DE BARROS MOREIRA,Rafael Campbell', 'ÍNDICE AMTEC Vol.2', '______', 0, '56a6fa53b9987a5c193dfa5e0eac2a1a.jpg', '38d004629bf47b973c0dc082af033ddb.jpg'),
(234, '______', 'Foto multiverso 10', '______', 0, '1f794b17e2219be55d2680b1a5c425d6.jpg', 'b818914b3ed8f5512d6b898bb52a2927.jpg'),
(237, '______', 'Foto multiverso 11', '______', 0, 'fa210b1c2b41f88c6b2f8d629425e72b.jpg', 'c674f931db1cb8034de20b7113282897.jpg'),
(238, '______', 'Foto multiverso 12', '______', 0, '5144461229aa4f6cdff04f01a6631b9b.jpg', 'c2339790d612dd5a9a815b22390ebf02.jpg'),
(239, '______', 'Foto multiverso 13', '______', 0, '4d3971c6d8556944c5475843c38fa90a.jpg', '4ae52672d98b5eca85fe2ba58457deaf.jpg'),
(240, '______', 'Foto multiverso 14', '______', 0, '7038049fd344cf4fdd835cfcac7021e7.jpg', 'a5df24b7e46a15611ce2c669245be15f.jpg'),
(241, '______', 'Foto multiverso 15', '______', 0, '8c5b4e03d383afd56d4c788b3e4d7c18.jpg', '08ed53da94516f956a7b3e8b02822f17.jpg'),
(242, '______', 'Foto multiverso 16', '______', 0, '3cfa3ef8f216a683b86aa39e21afbe88.jpg', '66a4332c15b1a85d5d73d03059dc49d5.jpg'),
(243, '______', 'Foto multiverso 17', '______', 0, 'e32c103b29b7e14510584a62d20f5bbb.jpg', 'aa04d0aa24fc8a7182d82fa856b44c14.jpg'),
(244, '______', 'Foto multiverso 18', '______', 0, 'd4b390fdb0f8ab0d20e266615d8ee918.jpg', '05ddfbb27ee7e8ca9f85f0beb2042ccf.jpg'),
(245, '______', 'Museomix', '______', 0, 'd4172162ee4db83365b084280622d9bf.jpg', 'a8c636c94766d62fcae01e01068da515.jpg'),
(246, 'MATTHEWS,Michael', 'Email', '______', 0, 'a0eee1c386382f9c1bf5a36512139272.jpg', '8e8490d85908fcd2f63227d8655bdb14.jpg'),
(247, '______', 'ÍNDICE DE ANALOGIAS E METÁFORAS', '______', 0, '42cada12f793e9c2561bc9cea3151b08.jpg', '1e7fb6cda79a56aa1d400b88b478b0b8.jpg'),
(248, '______', 'CURRÍCULO INTEGRADO', '______', 0, '504b2b881c593ecc4f2a61486280e27d.jpg', '586df7d3172854ee8457de100099a9ff.jpg'),
(249, '______', 'POLÍTICAS DE FORMAÇÃO DOCENTE PARA A EDUCAÇÃO  PROFISSIONAL  ', '______', 0, 'bf7c539c4118f4a2696cc672e0315146.jpg', '3643276b0ad9b95a179b11577192e029.jpg'),
(250, '______', 'Foto multiverso 19', '______', 0, '15756501eed58aadee27407bafc77c8f.jpg', '7e85c2bbcf635bf6969305b691cc146b.jpg'),
(251, 'FONSECA,Eliane G Silva ; NAGEM,Ronaldo Luiz', 'Implicações da teoria de Vygotsky processos de aprendizagem que envolvam a utilização de analogias e metáforas na construção e (re)significação de conhecimento', '______', 0, 'a0ba70a7fb83750e92c2682172d256ac.jpg', '3fc95eadd45940988a37370767ffd312.jpg'),
(252, 'NAGEM,Ronaldo Luiz;MOURA,Dácio;RAMALHO,Flávia', 'Modelos mentais no processo de ensino e aprendizagem:ar atmosférico', '______', 0, '73a0a60570f26478239ddc1059b0703c.jpg', 'f20bafed5c4fabb17cb0492fdbd7a7b1.jpg'),
(253, 'EMAR DE ALMEIDA,Délcio J.;NAGEM,Ronaldo Luiz;GINO,Maurício Silva', 'Espaço \"multiverso\":Reconstrução de modelo análogo para ambiente não formal de educação em ciências destinado ao ensino de astronomia', '______', 0, '8b5129bd2dbbb0314fa8a2b5f39e8140.jpg', '206d2d00832c7eac17c1c182d1af8cf1.jpg'),
(254, 'SILVA, Vanessa Corrêa; NAGEM, Ronaldo Luiz', 'Uso de modelos analogias e metáforas na educação afetivo-sexual nos primeiros anos do ensino fundamental', '______', 0, 'bebe974dafeb133a5acc581050e1198d.jpg', '88d5f1e3b348ed31131b7bcc7a8aa4e5.jpg'),
(255, 'NAGEM,Ronaldo Luiz;MARCELOS,Maria de Fátima;RAMALHO,Flávia', 'Representação analógicas de alunos da educação de jovens e adultos para o conceito de ar atmosférico', '______', 0, 'd9a07f6b226d8dd4e93b69f309418467.jpg', '2acbd1cc47c76925d2617c591c3a540b.jpg'),
(256, 'NAGEM, Ronaldo Luiz; CARVALHAES, Dulcinéia de Oliveira', 'Abordagem de analogias em ambientes interacionistas na educação', '______', 0, '4ff88499f8a53c29bcee76ff2d5313bd.jpg', '219193de83e837aec21fe0e942cf6932.jpg'),
(257, 'CARVALHAES,Dulcinéia de Oliveira', 'Grupo de estudo de metáforas e analogias,na tecnologia,na educação e na ciência GEMATEC', '______', 0, 'd89e3be22fc18e8046e12cdd932e805b.jpg', '977f185623d85b1837b8b26d3f9d2fde.jpg'),
(258, 'NAGEM,Ronaldo Luiz', 'Dois parâmetros para a seleção de livros didáticos:analogias e metáforas', '______', 0, 'e69de579a95cdadc64c0b7ba963334d4.jpg', '98f29c971ad5d58ae18174e9de9e603e.jpg'),
(259, 'GOMES E SILVA,Cínthia Maria', 'Uma proposta de metodologia investigativa para o pensamento e a linguagem metafóricos e sua atividade no sistema cerebral', '______', 0, '61237d57bbd4155da59e90f5e2e0df9d.jpg', 'de7c86cac559596c316b47f09c5ef5e1.jpg'),
(260, 'ARAÚJO, Isabel Campos; NAGEM, Ronaldo Luiz', 'A construção do conhecimento por meio da aplicação de analogias:uma proposta para o trabalho docente no ensino de ciências', '______', 0, '3a98cded64bcf7dd6de527262a70eb7e.jpg', '1367a7105fbc519b380c48ba151fb22a.jpg'),
(261, 'PEREIRA,Ana Cristina Carvalho', 'Linguagem e cognição:analogias e metáforas como um recurso didático no ensino da dança clássica', '______', 0, 'cdc101a479c52efb193a85e75ad136d6.jpg', 'fd9190740bca4e1b7c3b338162cdb7c0.jpg'),
(262, 'MARCELOS,Maria de Fatima', 'Mapeamento analógico e metafórico da obra \"A origem das espécies\" de Charlie R.Darwin', '______', 0, '091c300aeaa99dd9a7088e2aa1881d87.jpg', 'f14dea91f83dbe1347715bd0b11264ad.jpg'),
(263, 'AMARAL, Silvia Eugênia do', 'Analogias e metáforas veiculadas na mídia institucional sobre educação afetivo sexual no Brasil', '______', 0, '263cbf9f377d8db5075f51571c5e5ef8.jpg', '01c3720c7b573383ad15e789d027fd33.jpg'),
(264, 'DUARTE,Juliana Barbosa', 'O uso da linguagem metafórica na comunicação institucional da CEMIG ', '______', 0, 'fb22c19f08d1275cf433f8c00d7a7f4c.jpg', '102f4d607eed2ce3e40631a2413dd92a.jpg'),
(265, 'AMARAL, Silvia Eugênia do', 'Analogias e metáforas na educação sexual interpretação de campanha institucional DST/HIV/Aids por mulheres negras', '______', 0, '276a2001e88d13f8f7fbf3884bf6338d.jpg', '32bbfd8d389b36828fe3ee6f4e06e070.jpg'),
(266, 'LIMA,Niuza Eugênia do Amaral', 'Ensino da informatica intermediado por analogias e metáforas', '______', 0, 'd887598cb819aa188bdc7276d9a5be14.jpg', '1ed40191b292e29b22410ab7f400c829.jpg'),
(267, 'NAGEM,Ronaldo Luiz ; MORAIS Welerson Rezende', 'O uso de modelos analógicos tridimensionais virtuais no processo de ensino e de aprendizagem de ciências ', '______', 0, 'c9347fda0cd72086e691c93a27d6197b.jpg', '3cd896f514e1b73f4276717ee9b80fa2.jpg'),
(268, 'NAGEM,Ronaldo Luiz ; RESENDE,Lilian Valim', 'Gravidez:Algumas concepções metafóricas de adolescentes grávidas', '______', 0, '544bd8abf46459f2066c81f7ff3fadb7.jpg', '6716f150a27a21b1f160a796c33534b6.jpg'),
(269, 'MARCELOS, Maria de Fátima', 'Analogias e metáforas na árvore da vida de Charles Darwin e a prática escolar', '______', 0, '976556fa6898422bdf754e93a8334477.jpg', 'ac2b720fc85eafe1dd388e01e5dd674e.jpg'),
(270, '______', 'ARTE ', '______', 0, '6bca27103cf7a53c96b7fa919e5eab70.jpg', '11770ea7747b28647e64a7e8ac3d9c35.jpg'),
(271, 'CARVALHAES, Dulcinéa de Oliveira', 'A abordagem de analogias em ambientes interacionistas na educação , na ciência e na tecnologia', '______', 0, 'e07a37e550b67ce492d3e1e2f0f17d14.jpg', 'f621402810b7707085e9fe656df5c000.jpg'),
(272, '______', 'O tamanho dos planetas e do Sol ', '______', 0, 'c30161506eb9caa5875a86c82e75a6e9.jpg', '781191c52a60583d49450287d96ee481.jpg'),
(273, '______', 'INFORMATIVO', '______', 0, '8fae5960bca651cbca0152a555a5d0be.jpg', 'f39d697bc26b5d4875c6a8e8d707ea81.jpg'),
(274, '______', 'JOGO', '______', 0, 'f400be57c88265ca738661bc06128ea4.jpg', 'c426ad9ca249255272bea5e29311b448.jpg'),
(275, 'FERRY, Alexandre; LEITE, Laurinda', 'Analogias e outros tipos de comparação no contexto das teorias atômicas em livros didáticos portugueses de ciências físico-químicas', '______', 2018, 'ba499675a55052555424213a55c799dd.jpg', '091f2692e7619263b57263117908ed01.jpg'),
(276, 'AGOSTINHO,Graciela ; ANDRADE,Ivanise ; COSTA,Helen ; FORTUNATO, Zélia; GONÇALVES ...', 'Padrão de comportamento de gênero na escola:discursos docentes e discentes na interpretação das histórias infantis ', '______', 0, '09c0f4f6acd94baa221dba6302a09360.jpg', '1dbf269a029d7cd281be83bc78476372.jpg'),
(277, 'BARBOSA,Mônica Cristina Combat', 'Linguagem metafórica e analógica, possibilidades metodológicas , interativas e mediáticas de ensino via e-leaning.', '______', 0, 'ac39ef21e01392779e92bd4e4210cf49.jpg', 'e1a1f0e65df1018df6d93755637fb987.jpg'),
(279, 'FERREIRA, Helton Luiz Dias; FERRY, Alexandre da Silva', 'Ilustrações em analogias empregadas no ensino de cinética química em livros didáticos', '______', 2018, '0dc41088c50d16b1ae84f72028e277e3.jpg', 'eec026e9973dfdaad08c22105bfe4c5e.jpg'),
(280, 'ASSIS, Luciana Paula de; FERRY, Alexandre da Silva;', 'Potencialidades e Limitações Pedagógicas na Utilização de Modelos Analógicos no Ensino da Estequiometria', '______', 2018, '0ed0459adc2a81623bc1d61995895dca.jpg', '4c8491d1d415e3c0ede879ec83a572bd.jpg'),
(281, 'BARBOSA, Wilbert Viana; FERRY, Alexandre da Silva', 'MAPES: Uma Ferramenta Digital para Suporte na Análise de Analogias', '______', 2018, '25daf6e58d7fccb3b5a373125429ebfe.jpg', '68443c5bf5ed24f178245afd27fd9fd7.jpg'),
(282, 'FONSECA, Rafael Bruno da Cunha; FERNANDES, Rayane de Souza; MAGALHÃES, Renato José de; FERRY, Alexandre da Silva', 'Base de dados digital sobre conjuntos expositivos baseados em modelagem', '______', 2018, 'db77937b9ac5b150447b51224b28b536.jpg', '4c0ede3dc6340e43e9abc69d6cc6c092.jpg'),
(283, 'SCHMIDT, Núbia Silva; FERRY, Alexandre da Silva', 'Dificuldades no ensino e aprendizagem de conteúdos de química por estudantes deficientes visuais', '______', 2018, '908754cc26b8a2bfa6da9d36e76d3726.jpg', '2a0275776c51e7401de53ee143ca8821.jpg');

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `apresentacoes`
--
ALTER TABLE `apresentacoes`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `arquivos`
--
ALTER TABLE `arquivos`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `convites`
--
ALTER TABLE `convites`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `genero`
--
ALTER TABLE `genero`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `livros`
--
ALTER TABLE `livros`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `tipo`
--
ALTER TABLE `tipo`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id_user`);

--
-- Índices para tabela `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `apresentacoes`
--
ALTER TABLE `apresentacoes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT de tabela `arquivos`
--
ALTER TABLE `arquivos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT de tabela `convites`
--
ALTER TABLE `convites`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT de tabela `genero`
--
ALTER TABLE `genero`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de tabela `livros`
--
ALTER TABLE `livros`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT de tabela `tipo`
--
ALTER TABLE `tipo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de tabela `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=286;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
