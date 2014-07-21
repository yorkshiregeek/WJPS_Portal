-- phpMyAdmin SQL Dump
-- version 4.1.12
-- http://www.phpmyadmin.net
--
-- Host: localhost:8889
-- Generation Time: Jul 21, 2014 at 09:12 AM
-- Server version: 5.5.34
-- PHP Version: 5.5.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `ATHP`
--

-- --------------------------------------------------------

--
-- Table structure for table `contacts`
--

CREATE TABLE `contacts` (
  `ContactIDLNK` int(11) NOT NULL AUTO_INCREMENT,
  `TrustIDLNK` int(11) NOT NULL,
  `PositionIDLNK` int(11) NOT NULL,
  `Name` varchar(250) NOT NULL,
  `Email` varchar(250) NOT NULL,
  `Telephone` varchar(250) NOT NULL,
  `Deleted` varchar(1) NOT NULL,
  PRIMARY KEY (`ContactIDLNK`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=53 ;

--
-- Dumping data for table `contacts`
--

INSERT INTO `contacts` (`ContactIDLNK`, `TrustIDLNK`, `PositionIDLNK`, `Name`, `Email`, `Telephone`, `Deleted`) VALUES
(1, 1, 1, 'Test Person', 'Test@email.com', '', '0'),
(2, 3, 2, 'Alison Ewing', 'Alison.Ewing@rlbuht.nhs.uk', '01752 431237', '0'),
(3, 4, 2, 'Andrew Davies', 'andrew.davies@nbt.nhs.uk', '0117 3235440', '0'),
(4, 5, 15, 'Ann Mounsey', 'ann.mounsey@imperial.nhs.uk', '07986 357097', '0'),
(5, 6, 2, 'Inderjit Singh', 'inderjit.singh@bch.nhs.uk', 'TBC', '0'),
(6, 7, 2, 'Carol Farrow', 'carol.farrow@nnuh.nhs.uk', 'TBC', '0'),
(7, 8, 3, 'Chris Barrass', 'Chris.Barrass@kch.nhs.uk', 'TBC', '0'),
(8, 9, 2, 'Chris Evans', 'chris.evans@stgeorges.nhs.uk', 'TBC', '0'),
(9, 10, 3, 'Damian Child', 'damian.child@sth.nhs.uk', 'TBC', '0'),
(10, 11, 15, 'Darrell Baker', 'darrell.baker@cardiffandvale.wales.nhs.uk', '02920 742995', '0'),
(11, 12, 2, 'David Corral', 'David.Corral@hey.nhs.uk', 'TBC', '0'),
(12, 13, 2, 'David Pitkin', 'david.pitkin@york.nhs.uk', 'TBC', '0'),
(13, 14, 6, 'David Webb', 'david.webb@londonscg.nhs.uk', '020 7869 5131', '0'),
(14, 15, 2, 'Debra Walker', 'debra.walker@alderhey.nhs.uk', 'TBC', '0'),
(15, 16, 15, 'Julia Tolan', 'julia.tolan@belfasttrust.hscni.net', 'TBC', '0'),
(16, 17, 4, 'Helen Howe', 'helen.howe@addenbrookes.nhs.uk', '01223 217479 ', '0'),
(17, 18, 8, 'Jatinder Harchowal', 'Jatinder.Harchowal@bsuh.nhs.uk', '01273 664932', '0'),
(18, 19, 9, 'Bhulesh Vadher ', 'Bhulesh.Vadher@ouh.nhs.uk', 'TBC', '0'),
(19, 20, 3, 'Charlotte Skitterall ', 'charlotte.skitterall@uhsm.nhs.uk ', '0161 9987070', '0'),
(20, 21, 8, 'Justine Scanlan', 'justine.scanlan@srft.nhs.uk', 'TBC', '0'),
(21, 22, 2, 'Karen Robertson', 'karen.robertson@chelwest.nhs.uk', 'TBC', '0'),
(22, 23, 2, 'Liz Kay', 'Liz.Kay@leedsth.nhs.uk', '0113 3926290 PA', '0'),
(23, 24, 10, 'Mags Norval', 'mags.norval@aintree.nhs.uk', 'TBC', '0'),
(24, 25, 11, 'Malcolm Partridge', 'malcolm.partridge@nuh.nhs.uk', '0115 9709199', '0'),
(25, 26, 3, 'Mark Easter', 'mark.easter@uhcw.nhs.uk', '02476 966769', '0'),
(26, 27, 12, 'Martin Stephens', 'Martin.Stephens@dh.gsi.gov.uk', '02380 798551/07777 4702603', '1'),
(27, 28, 4, 'Michael Scott', 'DrMichael.Scott@northerntrust.hscni.net', '028 9442 400', '0'),
(28, 29, 4, 'Neil Watson', 'Neil.Watson2@nuth.nhs.uk', '0191 2824220', '0'),
(29, 30, 13, 'Norman Lannigan', 'Norman.Lannigan@ggc.scot.nhs.uk', '0141 2015337', '0'),
(30, 32, 4, 'Tom Gray', 'Tom.Gray@nhs.net', '01332 785562', '1'),
(31, 32, 15, 'Clive Newman', 'Clive.Newman1@nhs.net', '01332 786553', '0'),
(32, 33, 3, 'Stephen Brown', 'stephen.brown@ubht.nhs.uk', '0117-3422772', '0'),
(33, 34, 2, 'Tania Carruthers ', 'tania.carruthers@heartofengland.nhs.uk', '0121 42 42446 ', '0'),
(34, 31, 15, 'Ewan Morrison', 'ewan.morrison@luht.scot.nhs.uk ', '0131 5361000', '0'),
(35, 35, 2, 'David Campbell', 'david.campbell@nhct.nhs.uk', 'TBC', '0'),
(36, 36, 2, 'Judith Vincent', 'Judith.Vincent@wales.nhs.uk', 'TBC', '0'),
(37, 37, 3, 'Pippa Roberts', 'p.roberts3@nhs.net', '', '0'),
(38, 38, 2, 'Richard Goodman', 'R.Goodman@rbht.nhs.uk', 'TBC', '0'),
(39, 39, 2, 'Richard Hey', 'Richard.Hey@cmft.nhs.uk', 'TBC', '0'),
(40, 42, 2, 'Susan Thomson', 'Susan.Thomson@uhns.nhs.uk', 'TBC', '0'),
(41, 43, 2, 'Suzanne Khalid', 'Suzanne.Khalid@uhl-tr.nhs.uk', 'TBC', '1'),
(42, 44, 2, 'Tony West', 'Tony.West@gstt.nhs.uk', 'TBC', '0'),
(43, 45, 2, 'Wendy Spicer', 'Wendy.Spicer@nhs.net', 'TBC', '0'),
(44, 46, 2, 'Robert Urquhart', 'robert.urquhart@uclh.nhs.uk', 'TBC', '0'),
(45, 41, 15, 'Sue Ladds', 'sue.ladds@uhs.nhs.uk', 'TBC', '0'),
(46, 40, 15, 'Stuart Semple', 'Stuart.Semple@bartsandthelondon.nhs.uk', 'N/A', '0'),
(47, 27, 15, 'Martin Stephens', 'Martin.Stephens@dh.gsi.gov.uk', 'N/A', '0'),
(48, 47, 15, 'Eimear McCusker', 'eimear.mccusker@belfasttrust.hscni.net', '', '0'),
(49, 43, 15, 'Bhavisha Pattani', 'bhavisha.pattani@uhl-tr.nhs.uk', '', '0'),
(50, 43, 15, 'Claire Elwood', 'claire.elwood@uhl-tr.nhs.uk', '', '0'),
(51, 48, 15, 'David Smith', 'david.smith@bthft.nhs.uk', '', '0'),
(52, 49, 2, 'Ray Fitzpatrick', 'rayfitzpatrick@nhs.net', '', '0');

-- --------------------------------------------------------

--
-- Table structure for table `documents`
--

CREATE TABLE `documents` (
  `IDLNK` int(11) NOT NULL AUTO_INCREMENT,
  `SectionIDLNK` int(11) NOT NULL,
  `Filename` varchar(255) NOT NULL,
  `URL` varchar(255) NOT NULL,
  `Description` text NOT NULL,
  `DateModified` varchar(12) NOT NULL,
  `FileSize` int(50) NOT NULL,
  `FileType` varchar(50) NOT NULL,
  `Deleted` int(1) NOT NULL,
  PRIMARY KEY (`IDLNK`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=154 ;

--
-- Dumping data for table `documents`
--

INSERT INTO `documents` (`IDLNK`, `SectionIDLNK`, `Filename`, `URL`, `Description`, `DateModified`, `FileSize`, `FileType`, `Deleted`) VALUES
(1, 1, 'iPhone intro.pdf', '', 'Test Document', '2010/10/15', 176640, 'application/x-pdf', 1),
(2, 2, 'ATHP constitution update June 2010', '', '', '2010/12/04', 47616, 'application/msword', 0),
(3, 3, 'Microsoft PowerPoint - ATHP 2010 (Nov 2010) - Final-pdf.pdf', '', '', '2010/12/02', 0, '', 1),
(4, 3, 'ATHP18Nov2010.pdf', '', '', '2010/12/02', 338345, 'application/pdf', 1),
(5, 3, 'ATHPNov2010.pdf', '', '', '2010/12/02', 148725, 'application/pdf', 1),
(6, 3, 'CD ATHP conference Nov 2010.pdf', '', '', '2010/12/02', 704490, 'application/pdf', 1),
(7, 3, 'PMSG  LPP - ATHP  - November 2010.pdf', '', '', '2010/12/02', 762719, 'application/pdf', 1),
(8, 3, 'Microsoft PowerPoint - PMSG  LPP - ATHP  - November 2010-pdf.pdf', '', '', '2010/12/02', 762719, 'application/pdf', 1),
(21, 4, 'ATHP Benchmarking.pdf', '', 'Author - Professor Liz Kay', '2010/12/04', 148725, 'application/pdf', 0),
(20, 4, 'Hospital Pharmacy - Next Steps.pdf', '', 'Author - Keith Ridge', '2010/12/04', 338345, 'application/pdf', 0),
(19, 4, 'North Central London - Inpatient Prescribing Chart.pdf', '', 'Author - Dr Yogini Jani', '2010/12/04', 1723643, 'application/pdf', 0),
(18, 4, 'Influencing Prescribing Practice.pdf', '', 'Author - Robert Offord', '2010/12/04', 2413743, 'application/pdf', 0),
(22, 4, 'Developing an Enquiry Driven Workforce.pdf', '', 'Author - Dr Catherine Duggan', '2010/12/04', 704490, 'application/pdf', 0),
(23, 4, 'NHS Collaborative Clinical Medicines Procurement.pdf', '', 'Author - Peter Sharott', '2010/12/04', 762719, 'application/pdf', 0),
(24, 4, 'NPSG presentation for ATHP.ppt', '', '', '2010/12/04', 2579456, 'application/vnd.ms-powerpoint', 1),
(25, 4, 'PMSG  LPP - ATHP  - November 2010.ppt', '', '', '2010/12/04', 928768, 'application/vnd.ms-powerpoint', 1),
(26, 4, 'Quality, Efficiency and Productivity.pdf', '', 'Author - David Webb', '2010/12/04', 4053194, 'application/pdf', 0),
(27, 4, 'National Pharmaceutical Procurement Challenges and Roles NPSGB.pdf', '', 'Author - Andrew Alldred', '2010/12/05', 3789648, 'application/pdf', 0),
(28, 4, 'Comet Letter.docx', '', '', '2011/01/25', 19303, 'application/vnd.openxmlformats-officedocument.word', 1),
(29, 4, 'F:Test upload.doc', '', 'Test purposes only to be deleted', '2011/01/27', 24576, 'application/octet-stream', 1),
(30, 4, 'Test upload', '', 'testing only', '2011/01/27', 24576, 'application/msword', 1),
(31, 2, 'Batch Query.sql', '', '', '2011/01/27', 3314, 'application/octet-stream', 1),
(32, 5, '2010-11-18 : Minutes of Meeting.doc', '', '', '2011/01/30', 71680, 'application/msword', 1),
(39, 5, '2010-11-18 : Business Agenda.doc', '', '18 November 2010 - UCLH, London', '2011/01/30', 96768, 'application/msword', 1),
(33, 5, 'NUTH Hosted ATHP Meeting.doc', '', '29 April 2010 - Newcastle', '2011/01/30', 37376, 'application/octet-stream', 1),
(34, 5, '2009-05-17 : Minutes of Meeting.doc', '', '7 May 2009 - Glasgow\r\n', '2011/01/30', 38400, 'application/octet-stream', 1),
(35, 5, '2009-19-11 : Minutes of Meeting.doc', '', '', '2011/01/30', 40960, 'application/octet-stream', 1),
(36, 5, '2010-04-29 : Minutes of Meeting.doc', '', '', '2011/01/30', 37376, 'application/octet-stream', 1),
(38, 5, '2010-04-29 : Agenda.doc', '', '29 April 2010 - Newcastle', '2011/01/30', 35840, 'application/msword', 1),
(37, 5, '2009-19-11 : Agenda.doc', '', '19 November 2009 - Bristol', '2011/01/30', 253440, 'application/msword', 1),
(40, 5, '2010-11-18 : Agenda', '', '18 November 2010 - UCLH, London', '2011/01/30', 66048, 'application/msword', 1),
(41, 7, ' Consultation Response - CPD Framework.doc', '', '', '2011/06/20', 48128, 'application/octet-stream', 0),
(42, 7, 'Consultation Response - Chemotherapy Measures 11/10 - 02/11.doc', '', '', '2011/06/27', 49152, 'application/msword', 0),
(43, 7, 'Consultation Response - GMC Prescribing & Med Devices 04/11.doc', '', '', '2011/06/20', 94208, 'application/msword', 0),
(44, 4, '2010-11-18 : Agenda', '', '', '2011/06/27', 66048, 'application/msword', 0),
(45, 4, '2010-11-18 : Business Agenda', '', '', '2011/06/27', 96768, 'application/msword', 0),
(46, 4, '2010-11-18 : Minutes of Meeting', '', '', '2011/06/27', 71680, 'application/msword', 1),
(47, 10, '2009-19-11 : Agenda.doc', '', '', '2011/06/27', 253440, 'application/msword', 0),
(48, 10, '2009-19-11 : Minutes of Meeting.doc', '', '', '2011/06/27', 40960, 'application/msword', 0),
(49, 11, '2009-05-17 : Minutes of Meeting.doc', '', '', '2011/06/27', 38400, 'application/msword', 0),
(50, 9, '2010-04-29 :  Agenda .doc', '', '', '2011/06/27', 35840, 'application/msword', 0),
(51, 9, '2010-04-29 : Minutes of Meeting.doc', '', '', '2011/06/27', 37376, 'application/msword', 0),
(52, 12, '2011-06-30 : Agenda', '', '', '2011/06/30', 29696, 'application/msword', 0),
(53, 12, '2011-06-30 : Business Agenda', '', '', '2011/06/30', 199168, 'application/msword', 0),
(54, 4, '2010-11-18 : Minutes of Meeting', '', '', '2011/07/04', 71680, 'application/msword', 0),
(55, 8, 'Day Case Prescription Charges.doc', '', '', '2011/07/06', 94208, 'application/octet-stream', 0),
(56, 12, '2011-06-30 : Presentations.pdf', '', 'NHS Commissioning - Quality & Leadership / Do Pharmacists make a difference? The EM contributions audit / Lean in Clinical Pharmacy â€“ the Leicester experience / Optimising medicines use at RDH / National standards for medicines management / Internal trading principles / New Community Pharmacy Contract / Modernising Pharmacy Manufacturing\r\n\r\nBenchmarking for quality and performance\r\n\r\nSeamless medicines management - the Nottingham experience', '2011/07/18', 2061557, 'application/pdf', 0),
(57, 13, 'Comparison Template.doc', '', '', '2011/07/18', 81408, 'application/msword', 1),
(58, 14, 'Annual Report - Sheffield Medicines Management & Therapeutics Committee.pdf', '', '', '2011/07/27', 33471, 'application/pdf', 0),
(59, 14, 'Five year plan - Royal Brompton.pdf', '', 'This is a plan.', '2011/07/27', 17623, 'application/pdf', 0),
(60, 15, 'Sheffield - Prescribing and medicines management strategy 2011 .pdf', '', '', '2011/07/19', 37634, 'application/pdf', 0),
(61, 15, 'Medicine Safety Committee report.pdf', '', '', '2011/07/19', 76098, 'application/pdf', 0),
(62, 14, 'Annual report 2010 - Heart of England.pdf', '', '', '2011/07/27', 226183, 'application/pdf', 0),
(63, 14, 'Annual Report - Sheffield Medicine Safety Committee.pdf', '', '', '2011/07/27', 76098, 'application/pdf', 0),
(64, 8, 'Comparison - Developing Pharmacy Careers.doc', '', '', '2011/07/27', 71680, 'application/msword', 0),
(65, 12, '2011-06-30 : Minutes of Meeting.doc', '', '', '2011/08/09', 64512, 'application/msword', 0),
(66, 16, 'Invitation to join advisory group', '', 'Advisory Group for Hospital Standards', '2011/08/10', 208896, 'application/octet-stream', 0),
(67, 17, 'Benchmarking - Proposed Criteria.doc', '', '', '2011/08/11', 39424, 'application/msword', 0),
(68, 17, 'Benchmarking - Data Collection Tool.doc', '', '', '2011/08/11', 85504, 'application/msword', 0),
(69, 18, '2011-17-11 : Business Agenda', '', '', '2011/12/07', 105984, 'application/msword', 0),
(70, 18, '2011-17-11 : Agenda', '', '', '2011/12/07', 47616, 'application/msword', 0),
(72, 18, 'UK Medicines Legislation Consolidation', '', 'Martin Knowles - East & South East England', '2011/12/09', 442909, 'application/pdf', 0),
(71, 18, '2011-17-11 : Sponsorhip Information', '', '', '2011/12/07', 17374, 'application/vnd.openxmlformats-officedocument.word', 1),
(73, 18, 'Quantifying Interventions', '', 'Sharron Millen - University Hospital Southampton', '2011/12/09', 883432, 'application/pdf', 0),
(74, 18, 'The Dementia Call for Action', '', 'Surinder Bassan - UHS\r\nProfessor Alistair Burns', '2011/12/09', 949797, 'application/pdf', 0),
(75, 18, 'The New Medicines Service', '', 'Tom Gray - East Midlands NHS', '2011/12/09', 261170, 'application/pdf', 0),
(76, 18, 'Steering Group on Improving the Use of Medicines', '', 'Rob Darracott - Company Chemist''s Association', '2011/12/09', 755148, 'application/pdf', 0),
(77, 18, 'Quantifying Interventions - BSUH', '', 'Alison Warren - Brighton & Sussex University Hospitals', '2011/12/09', 346749, 'application/pdf', 0),
(78, 18, 'Development of Hospital Pharmacy Standards', '', 'Catherine Duggan - Director of Professional Development & Support RPS', '2011/12/09', 690702, 'application/pdf', 0),
(79, 18, 'Pharmacy Interventions', '', 'Mark Tomlin - SUHT', '2011/12/09', 888074, 'application/pdf', 0),
(80, 18, 'South Central Approach to QIPP', '', 'Bhulesh Vadher - Oxford Radcliffe Hospitals NHS Trust', '2011/12/09', 1319300, 'application/pdf', 0),
(81, 18, 'The Development of Quality Indicators at UHB', '', 'Dr Jamie Coleman - University Hospital Birmingham', '2011/12/09', 1500768, 'application/pdf', 0),
(82, 18, 'Wast e QIPP South Central', '', 'Medicines Waste Self Assessment', '2011/12/09', 37238, 'application/pdf', 0),
(83, 18, 'Update on next steps after the Finnamore Aseptics Unit meeting', '', '', '2011/12/09', 8770, 'application/pdf', 0),
(84, 18, '2011-17-11 : Sponsorhip Information', '', '', '2011/12/12', 50846, 'application/pdf', 0),
(85, 17, 'Benchmarking - Analysis.xls', '', '', '2011/12/13', 95744, 'application/octet-stream', 0),
(86, 19, 'Sponsorship Agreement.doc', '', '', '2012/06/07', 55296, 'application/msword', 0),
(87, 20, '2012-27-04 : Agenda', '', '', '2012/06/20', 31808, 'application/pdf', 0),
(88, 20, '2012-27-04 : Business Agenda.doc', '', '', '2012/06/20', 1097728, 'application/octet-stream', 1),
(89, 20, '2012-27-04 : Business Agenda.doc', '', '', '2012/06/20', 1097728, 'application/msword', 1),
(90, 20, '2012-27-04 : Business Agenda', '', '', '2012/06/20', 1094144, 'application/msword', 0),
(91, 2, 'Agenda Item Summary Sheet', '', '', '2012/06/20', 436224, 'application/msword', 0),
(92, 16, 'Community Pharmacy Partnership Project - 06/03/12', '', 'Imperial College Healthcare NHS Trust', '2012/06/20', 1462272, 'application/msword', 0),
(93, 16, 'NPSG - 120512 IV Brief', '', 'CMU framework agreements for the supply of IV fluids and topical solutions: market conditions and associated price increases', '2012/06/20', 81920, 'application/msword', 0),
(94, 20, 'Reputational Damage', '', 'Patrick Crowley - Chief Executive, York Teaching Hospitals NHS Foundation Trust', '2012/06/20', 2949632, 'application/vnd.ms-powerpoint', 0),
(95, 20, 'When things go wrong', '', 'Tony West - Chief Pharmacist & Clinical Director, Guys & St Thomas'' NHS Foundation Trust', '2012/06/20', 1021952, 'application/vnd.ms-powerpoint', 0),
(96, 20, 'Bridging the Divide - New Services, New Communications', '', 'Gary Warner - Pharmaceutical Services Negotiating Committee', '2012/06/20', 1283072, 'application/vnd.ms-powerpoint', 0),
(97, 20, 'The Future of Pharmacy Education & Training', '', 'Dr Sue Ambler - Modernising Pharmacy Careers Programme Director, DoH', '2012/06/20', 778752, 'application/vnd.ms-powerpoint', 0),
(98, 20, 'F:ATHPMeetingsPresentationsApril 2012Lynn Ridley - Talk to chief pharmacistsv3.ppt', '', '', '2012/06/20', 3557888, 'application/vnd.ms-powerpoint', 1),
(99, 20, 'Innovative Purchasing', '', 'Phil Deady, Pharmacy Procurement Manager, LTHT', '2012/07/12', 971264, 'application/vnd.ms-powerpoint', 0),
(100, 20, 'Benchmarking', '', 'Clare Howard & Liz Kay', '2012/07/12', 1954816, 'application/vnd.ms-powerpoint', 0),
(101, 20, 'Medico-legal pharmaceutical issues', '', 'Peter Merchant - DAC Beachcroft', '2012/07/12', 567808, 'application/vnd.ms-powerpoint', 0),
(102, 16, 'Community Pharmacy Partnership Project - 03/07/12', '', 'Imperial College Healthcare NHS Trust', '2012/07/12', 314368, 'application/octet-stream', 0),
(103, 22, 'Band 7 Training Pack ATHP November 2012.pdf', '', 'Emma Graham-Clarke, AHP/HCS Lead - BBCCCN', '2013/11/15', 519459, 'application/pdf', 1),
(104, 23, 'Collaboration for Leadership in Applied Health Research and Care & CLAHRC Medicines Related Projects ATHP April 2013.pdf', '', 'Louella Vaughan, Honorary Consultant in Acute Medicine', '2013/11/15', 2109905, 'application/pdf', 1),
(105, 22, 'Band 7 Training Pack ATHP November 2012.pdf', '', 'Emma Graham-Clarke, AHP/HCS Lead - BBCCCN, Midlands Critical Care Network', '2013/11/15', 519459, 'application/pdf', 0),
(106, 23, 'Collaboration for Leadership in Applied Health Research and Care & CLAHRC Medicines Related Projects ATHP April 2013.pdf', '', 'Louella Vaughan, Honorary Consultant in Acute Medicine, Chelsea and Westminster Hospital NHS Foundation Trust', '2013/11/15', 2109905, 'application/pdf', 0),
(107, 22, 'Comparing Hospital Medicines Use ATHP November 2012.ppt', '', 'Ray Fitzpatrick, Clinical Director of Pharmacy, Royal Wolverhampton NHS Trust & Professor of Pharmacy, Wolverhampton University', '2013/11/15', 4152320, 'application/vnd.ms-powerpoint', 0),
(108, 22, 'Innovation - Medicines Across the Interface ATHP November 2012.pptx', '', 'Professor Anthony Sinclair, Chief Pharmacist, Birmingham Children''s Hospital NHS Foundation Trust', '2013/11/15', 5077094, 'application/vnd.openxmlformats-officedocument.pres', 0),
(109, 22, 'Innovation in Patient Safety - Security of Patients'' Own Medicines at the Interface ATHP November 2012.ppt', '', 'Ruth Bendall, Pharmacy Team Leader, Medicine, University Hospital of North Staffordshire', '2013/11/15', 1560576, 'application/vnd.ms-powerpoint', 0),
(110, 23, 'Introduction to the HRA and the Collaboration and Development Projects ATHP April 2013.pdf', '', 'Anna Bischler, Lead Clinical Governance Pharmacist, Chelsea & Westminster Hospital and, Project Lead HRA Collaboration and Development Group', '2013/11/15', 204136, 'application/pdf', 0),
(111, 22, 'Links between UHNS Pharmacy and Keele University ATHP November 2012.ppt', '', 'Sue Thomson, Clinical Director & Carole Blackshaw, Principal Pharmacist Clinical Services', '2013/11/15', 244736, 'application/vnd.ms-powerpoint', 0),
(112, 22, 'Medicines Reconciliation ATHP November 2012.pptx', '', 'Clare Howard, National Lead QIPP Medicines Use and Procurement.', '2013/11/15', 4229982, 'application/vnd.openxmlformats-officedocument.pres', 0),
(113, 22, 'Navigating the New Landscape - A Perspective for Providers ATHP November 2012.pdf', '', 'Richard Seal, NHS Midlands and East (West Midlands)', '2013/11/15', 2628747, 'application/pdf', 0),
(114, 23, 'NHS England Structure and Impact on High Cost Drugs ATHP April 2013.pdf', '', 'Malcolm Qualie, Pharmacy Lead Specialised Services', '2013/11/15', 974286, 'application/pdf', 0),
(115, 23, 'Patients First and Foremost ATHP April 2013.pdf', '', 'Dr Keith Ridge, Chief Pharmaceutical Officer, Department of Health', '2013/11/15', 123726, 'application/pdf', 0),
(116, 23, 'Professional Development, Professional Leadership - Hospital Standards in Pharmacy ATHP April 2013.pdf', '', 'Dr Catherine Duggan, FRPharmS, Royal Pharmaceutical Society', '2013/11/15', 1672388, 'application/pdf', 0),
(117, 23, 'Professional Recognition through the RPS Faculty ATHP April 2013.pdf', '', 'Dr Catherine Duggan, Director, RPS, Royal Pharmaceutical Society', '2013/11/15', 1530542, 'application/pdf', 0),
(118, 23, 'Rebalancing Medicines Legislation and Pharmacy Regulation Programme ATHP April 2013.pdf', '', 'Ken Jarrold, CBE, Department of Health', '2013/11/15', 158596, 'application/pdf', 0),
(119, 23, 'Workforce LETBs, Foundation, General and Advanced Workforce Development ATHP April 2013.pdf', '', 'Professor Ian Bates, FRPharmS, FRSS, FRSPH, FFIP, Head Education Development, UCL School of Pharmacy; Workforce Facilitator, North-Central NHS Trusts; Director, FIP Education Development, RPS Representative to HEE and MPC', '2013/11/15', 1267612, 'application/pdf', 0),
(120, 23, 'Year of Care Tariff A New Way of Commissioning Cystic Fibrosis Services ATHP April 2013.pdf', '', 'Dr Diana Bilton, Adult CF Specialist, Royal Brompton Hospital', '2013/11/15', 772512, 'application/pdf', 0),
(121, 24, 'November 2013 Conference - Agenda', '', '', '2013/12/05', 78336, 'application/msword', 0),
(122, 24, 'November 2013 Conference - Delegates Speakers & Sponsors', '', '', '2013/12/05', 70656, 'application/msword', 0),
(123, 24, 'November 2013 Conference Speaker Presentation - Developing the Clinical Research Network (Anthea Mould)', '', '', '2013/12/05', 1511142, 'application/vnd.openxmlformats-officedocument.pres', 0),
(124, 24, 'November 2013 Conference Speaker Presentation - Medicines Optimisation (Clare Howard)', '', '', '2013/12/05', 1013060, 'application/vnd.openxmlformats-officedocument.pres', 0),
(125, 24, 'November 2013 Conference Speaker Presentation - Consultant Pharmacists Update (Katherine Sterling, Philip Howard, Heather Smith)', '', '', '2013/12/05', 763280, 'application/vnd.openxmlformats-officedocument.pres', 0),
(126, 24, 'S:\\kayl\\ATHP\\Nov 13 conference\\Speaker presentations\\PDFs\\EAK ATHP Nov 13 slides comp.pdf', '', '', '2013/12/05', 1829821, 'application/pdf', 0),
(127, 24, 'S:\\kayl\\ATHP\\Nov 13 conference\\Speaker presentations\\PDFs\\KH CPO Visit & MM Monthly Meeting May 2013 v2 ATHP comp.pdf', '', '', '2013/12/05', 3016113, 'application/pdf', 0),
(128, 24, 'S:\\kayl\\ATHP\\Nov 13 conference\\Speaker presentations\\PDFs\\KH Nuffield ATHP Nov13.pdf', '', '', '2013/12/05', 641704, 'application/pdf', 0),
(129, 24, 'S:\\kayl\\ATHP\\Nov 13 conference\\Speaker presentations\\PDFs\\LJ RPS ATHP Nov 2013 with notes comp.pdf', '', '', '2013/12/05', 2477221, 'application/pdf', 0),
(130, 24, 'November 2013 Conference Speaker Presentation - Medicines Optimisation (Richard Seal)', '', '', '2013/12/05', 2803523, 'application/vnd.openxmlformats-officedocument.pres', 0),
(131, 24, 'S:\\kayl\\ATHP\\Nov 13 conference\\Speaker presentations\\PDFs\\RS - ATHP presentation Nov 2013 comp.pdf', '', '', '2013/12/05', 951814, 'application/pdf', 0),
(132, 24, 'November 2013 Conference Speaker Presentation', '', '', '2013/12/05', 1572325, 'application/vnd.openxmlformats-officedocument.pres', 0),
(133, 24, 'November  2013 Conference Speaker Presentation - Specialised Medicines & Commissioning (Malcolm Quaile)', '', '', '2013/12/05', 4517888, 'application/vnd.ms-powerpoint', 0),
(134, 24, 'S:\\kayl\\ATHP\\Nov 13 conference\\Speaker presentations\\WS Experiences of RFL outsourced dispensary services.pptx', '', '', '2013/12/05', 91818, 'application/vnd.openxmlformats-officedocument.pres', 0),
(135, 14, 'WJPS', '', 'Test', '2014/06/29', 0, '', 1),
(136, 14, 'Test', 'http://www.wjps.co.uk', 'Test', '2014/06/29', 0, 'url', 1),
(137, 14, 'Rebecca Unique ID (6).pdf', 'http://localhost:8888/Portal/WJPS_Portal/Ajax-php/files/Rebecca%20Unique%20ID%20%286%29.pdf', 'Rebecca', '2014/06/29', 0, 'upload', 1),
(138, 14, 'Rebecca Unique ID (8).pdf', 'http://localhost:8888/Portal/WJPS_Portal/Ajax-php/files/Rebecca%20Unique%20ID%20%288%29.pdf', 'This', '2014/07/03', 0, 'upload', 1),
(139, 14, 'QCNW Portal Presentation 2014 (8).pptx', 'http://localhost:8888/Portal/WJPS_Portal/Ajax-php/files/QCNW%20Portal%20Presentation%202014%20%288%29.pptx', 'This', '2014/07/03', 0, 'upload', 1),
(140, 14, 'sdsclogont (2).png', 'http://localhost:8888/Portal/WJPS_Portal/Ajax-php/files/sdsclogont%20%282%29.png', 'Logo', '2014/07/03', 0, 'upload', 1),
(141, 14, 'Vago.jpg', 'http://localhost:8888/Portal/WJPS_Portal/Ajax-php/files/Vago.jpg', 'Test', '2014/07/03', 0, 'upload', 1),
(142, 14, 'berrimans page 5.jpg', 'http://localhost:8888/Portal/WJPS_Portal/Ajax-php/files/berrimans%20page%205.jpg', '', '2014/07/03', 0, 'upload', 1),
(143, 14, 'Nics page 2.jpg', 'http://localhost:8888/Portal/WJPS_Portal/Ajax-php/files/Nics%20page%202.jpg', '', '2014/07/03', 0, 'upload', 1),
(144, 14, 'the important bit !.jpg', 'http://localhost:8888/Portal/WJPS_Portal/Ajax-php/files/the%20important%20bit%20%21.jpg', '', '2014/07/03', 0, 'upload', 1),
(145, 14, 'Nics statement page 1.jpg', 'http://localhost:8888/Portal/WJPS_Portal/Ajax-php/files/Nics%20statement%20page%201.jpg', '', '2014/07/03', 0, 'upload', 1),
(146, 14, 'berrimans response.jpg', 'http://localhost:8888/Portal/WJPS_Portal/Ajax-php/files/berrimans%20response.jpg', '', '2014/07/03', 0, 'upload', 1),
(147, 14, 'berrimans page 5 (1).jpg', 'http://localhost:8888/Portal/WJPS_Portal/Ajax-php/files/berrimans%20page%205%20%281%29.jpg', '', '2014/07/03', 0, 'upload', 1),
(148, 14, 'QCNW Portal Presentation 2014 (9).pptx', 'http://localhost:8888/Portal/WJPS_Portal/Ajax-php/files/QCNW%20Portal%20Presentation%202014%20%289%29.pptx', '', '2014/07/03', 0, 'upload', 1),
(149, 14, 'QCNW Portal Presentation 2014 (10).pptx', 'http://localhost:8888/Portal/WJPS_Portal/Ajax-php/files/QCNW%20Portal%20Presentation%202014%20%2810%29.pptx', '', '2014/07/03', 0, 'upload', 1),
(150, 14, 'QCNW Portal Presentation 2014 (11).pptx', 'http://localhost:8888/Portal/WJPS_Portal/Ajax-php/files/QCNW%20Portal%20Presentation%202014%20%2811%29.pptx', '', '2014/07/03', 0, 'upload', 1),
(151, 14, 'New Name', 'http://localhost:8888/Portal/WJPS_Portal/Ajax-php/files/sdsclogont%20%283%29.png', '', '2014/07/03', 0, 'upload', 0),
(152, 14, 'Invite1 (6).ai', 'http://localhost:8888/Portal/WJPS_Portal/Ajax-php/files/Invite1%20%286%29.ai', '', '2014/07/06', 0, 'upload', 0),
(153, 2, 'Rebecca Unique ID (9).pdf', 'http://localhost:8888/Portal/WJPS_Portal/Ajax-php/files/Rebecca%20Unique%20ID%20%289%29.pdf', '', '2014/07/14', 0, 'upload', 0);

-- --------------------------------------------------------

--
-- Table structure for table `documenttags`
--

CREATE TABLE `documenttags` (
  `IDLNK` int(11) NOT NULL AUTO_INCREMENT,
  `DocumentIDLNK` int(11) NOT NULL,
  `TagIDLNK` int(11) NOT NULL,
  PRIMARY KEY (`IDLNK`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=21 ;

--
-- Dumping data for table `documenttags`
--

INSERT INTO `documenttags` (`IDLNK`, `DocumentIDLNK`, `TagIDLNK`) VALUES
(7, 151, 15),
(8, 151, 16),
(18, 152, 3),
(19, 152, 3),
(20, 153, 3);

-- --------------------------------------------------------

--
-- Table structure for table `documentusercategorys`
--

CREATE TABLE `documentusercategorys` (
  `IDLNK` int(11) NOT NULL AUTO_INCREMENT,
  `DocumentIDLNK` int(11) NOT NULL,
  `UserCategoryIDLNK` int(11) NOT NULL,
  PRIMARY KEY (`IDLNK`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=14 ;

--
-- Dumping data for table `documentusercategorys`
--

INSERT INTO `documentusercategorys` (`IDLNK`, `DocumentIDLNK`, `UserCategoryIDLNK`) VALUES
(8, 152, 2),
(9, 152, 1),
(10, 152, 8),
(11, 152, 9),
(12, 153, 2),
(13, 153, 1);

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `IDLNK` int(11) NOT NULL AUTO_INCREMENT,
  `Title` varchar(255) NOT NULL,
  `Details` text NOT NULL,
  `Location` varchar(255) NOT NULL,
  `EventDate` varchar(10) NOT NULL,
  `EventTime` varchar(10) NOT NULL,
  `Duration` varchar(50) NOT NULL,
  `Deleted` varchar(1) NOT NULL,
  PRIMARY KEY (`IDLNK`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`IDLNK`, `Title`, `Details`, `Location`, `EventDate`, `EventTime`, `Duration`, `Deleted`) VALUES
(1, 'Test Event', 'Details', 'Location', '2010/05/15', '15:00', '2 Hours', '1'),
(2, 'ATHP Spring Meeting', 'Thursday 26 April evening and Friday 27 April 2012,  Hilton, York \r\n\r\n', 'Hilton Hotel, York', '26 &/27/Ap', '', '', '0'),
(3, 'ATHP November Meeting', 'Evening session on Wednesday 28th November and a full programme on Thursday 29th November 2012 further details to be confirmed', 'Hilton Birmingham Metropole, NEC ', '12/11/28', 'TBC', '1 day', '0');

-- --------------------------------------------------------

--
-- Table structure for table `groups`
--

CREATE TABLE `groups` (
  `IDLNK` int(11) NOT NULL AUTO_INCREMENT,
  `GroupName` varchar(255) NOT NULL,
  `Description` text NOT NULL,
  `Deleted` varchar(1) NOT NULL,
  PRIMARY KEY (`IDLNK`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `groups`
--

INSERT INTO `groups` (`IDLNK`, `GroupName`, `Description`, `Deleted`) VALUES
(1, 'Test Group', 'Test', '1'),
(2, 'Governance', 'This section contains documents relating to ATHP Governanace.', '0'),
(3, 'Meetings', 'ATHP Agendas, Minutes and Presentations', '0'),
(4, 'Annual Reports', 'Trust Annual Reports', '0'),
(5, 'Medicines Management Strategies', '', '0'),
(6, 'Consultation Responses', 'Template & Responses', '0'),
(7, 'Trust Comparisons/Information', 'eg Information requests/sharing', '0'),
(8, 'Benchmarking', '', '0'),
(9, '2012 November, Birmingham', '', '1');

-- --------------------------------------------------------

--
-- Table structure for table `groupusercategorys`
--

CREATE TABLE `groupusercategorys` (
  `IDLNK` int(11) NOT NULL AUTO_INCREMENT,
  `GroupIDLNK` int(11) NOT NULL,
  `UserCategoryIDLNK` int(11) NOT NULL,
  PRIMARY KEY (`IDLNK`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=19 ;

--
-- Dumping data for table `groupusercategorys`
--

INSERT INTO `groupusercategorys` (`IDLNK`, `GroupIDLNK`, `UserCategoryIDLNK`) VALUES
(7, 4, 2),
(8, 4, 1),
(9, 4, 8),
(10, 4, 9),
(11, 3, 2),
(12, 3, 1),
(13, 3, 8),
(14, 3, 9),
(17, 2, 2),
(18, 2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `links`
--

CREATE TABLE `links` (
  `IDLNK` int(11) NOT NULL AUTO_INCREMENT,
  `Title` varchar(255) NOT NULL,
  `URL` varchar(255) NOT NULL,
  `Deleted` varchar(1) NOT NULL,
  PRIMARY KEY (`IDLNK`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `links`
--

INSERT INTO `links` (`IDLNK`, `Title`, `URL`, `Deleted`) VALUES
(1, 'Link 1 Test', 'http://www.wjps.co.uk', '1'),
(2, 'Association of Teaching Hospital Pharmacists', 'http://www.athp.org.uk', '0'),
(3, 'National Pharmaceutical Supplies Group', 'http://www.cmu.dh.gov.uk/national-pharmaceutical-supply-group-npsg/', '1');

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `IDLNK` int(11) NOT NULL AUTO_INCREMENT,
  `Title` varchar(255) NOT NULL,
  `Message` text NOT NULL,
  `ParentIDLNK` int(11) NOT NULL,
  `DateAdded` varchar(10) NOT NULL,
  `TimeAdded` varchar(10) NOT NULL,
  `PostedByIDLNK` int(11) NOT NULL,
  `Deleted` varchar(1) NOT NULL,
  PRIMARY KEY (`IDLNK`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=73 ;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`IDLNK`, `Title`, `Message`, `ParentIDLNK`, `DateAdded`, `TimeAdded`, `PostedByIDLNK`, `Deleted`) VALUES
(1, 'Test Message', '', 0, '2011/08/26', '', 1, '0'),
(2, 'Test Message', '', 0, '2011/08/26', '', 1, '0'),
(3, 'Test', 'This is a test message', 0, '2011/08/26', '', 1, '1'),
(4, 'Test', 'This is a test message', 0, '2011/08/26', '', 1, '1'),
(5, 'Associate Member', 'fsdfdsf', 0, '2011/08/26', '', 2, '1'),
(6, '', 'This is a reply', 0, '2011/08/30', '', 1, '0'),
(7, '', 'This is a reply', 0, '2011/08/30', '', 1, '0'),
(8, '', 'This is a a reply', 0, '2011/08/30', '', 1, '0'),
(9, '', 'This is a a reply', 0, '2011/08/30', '', 1, '0'),
(10, '', 'This is a a reply', 0, '2011/08/30', '', 1, '0'),
(11, 'Test', 'This is a a reply', 3, '2011/08/30', '', 1, '0'),
(12, 'Test', 'This is a a reply', 3, '2011/08/30', '', 1, '0'),
(13, 'Test', 'So what happens if I add alot of text it would be good to see if the whole thing is put on \r\n\r\nWhat about lines.', 3, '2011/08/30', '', 1, '0'),
(14, 'Test', 'But I still dont know if it wrapps properly, this is really confusing isnt it, go on you know that you want to be long enough this time to make sure that a good bit of wrapping happens', 3, '2011/08/30', '', 1, '0'),
(15, 'Associate Member', 'This is my bew post.', 5, '2011/08/30', '', 1, '0'),
(16, 'Test', 'This is my second post', 4, '2011/08/30', '', 1, '1'),
(17, 'Test', 'This is another', 4, '2011/08/30', '', 1, '1'),
(18, 'This is a member message', 'This is great I can do some cool things.', 0, '2011/08/30', '', 2, '1'),
(19, 'This is a member message', 'I am now adding a reply', 18, '2011/08/30', '', 2, '0'),
(20, 'This is a member message', 'This is another.', 18, '2011/08/30', '', 2, '0'),
(21, 'This is a member message', 'Greta.', 18, '2011/08/30', '', 1, '0'),
(22, 'This is a member message', '', 18, '2011/08/30', '', 1, '1'),
(23, '', '', 0, '2011/08/30', '', 1, '0'),
(24, '', 'dfgdf', 0, '2011/08/30', '', 1, '0'),
(25, '', '', 0, '2011/08/30', '', 1, '0'),
(26, '', '', 0, '2011/08/30', '', 1, '0'),
(27, '', '', 0, '2011/08/30', '', 1, '0'),
(28, '', '', 0, '2011/08/30', '', 1, '0'),
(29, 'This is a member message', '', 18, '2011/08/30', '', 1, '1'),
(30, 'This is a member message', '', 18, '2011/08/30', '', 1, '1'),
(31, 'This is a member message', 'dgdfgfd', 18, '2011/08/30', '', 1, '0'),
(32, 'This is a member message', 'Nicne one', 18, '2011/08/30', '', 1, '1'),
(33, '', 'My final reply.', 0, '2011/09/01', '08:15:56', 1, '0'),
(34, 'This is a member message', 'This is my final reply.', 18, '2011/09/01', '08:16:42', 1, '0'),
(35, 'This is a member message', 'Another', 18, '2011/09/02', '08:07:31', 1, '0'),
(36, 'This is a member message', 'And anoher', 18, '2011/09/02', '08:07:39', 1, '0'),
(37, 'This is a member message', 'This is a test to see how the email works.', 18, '2011/09/02', '08:13:26', 1, '0'),
(38, 'This is a member message', 'This is a test to see how the email works.', 18, '2011/09/02', '08:13:37', 1, '0'),
(39, 'This is a member message', 'This is a test to see how the email works.', 18, '2011/09/02', '08:13:53', 1, '0'),
(40, 'New Message', 'This is a new message to all.', 0, '2011/09/02', '08:14:17', 1, '1'),
(41, 'This is a message to all', 'ffsdfsdfdsfdsfdsfdsf dsg fdg fdsbfd dfg dfg dfg dfg df dfg dfg ', 0, '2011/09/02', '08:18:42', 1, '1'),
(42, 'This is a message to all', 'Great and now I am reply to this....\r\n\r\nI think this is working.', 41, '2011/09/02', '08:21:12', 1, '0'),
(43, 'This is a message to all', 'Another', 41, '2011/09/02', '08:22:30', 1, '0'),
(44, 'This is a message to all', 'Lets try this.', 41, '2011/09/02', '08:24:24', 1, '0'),
(45, 'This is a message to all', 'Ok this should work', 41, '2011/09/02', '08:27:05', 1, '0'),
(46, 'Business Agenda - 17/11/11', 'The Business Agenda is now uploaded to the website.  If you wish to add anything further to this please let Liz Kay or Helen Smith know as soon as possible.', 0, '2011/11/14', '10:48:24', 6, '0'),
(47, 'Mixing of Medicines', 'Hi all; good to see you in Brighton; thanks again to Jat and Surinder for teeing up an excellent meeting\r\n\r\nMessage from Martin Stephens detailed below\r\n\r\nPlease can one or two volunteer to look at the proposed solution (I can''t as i wrote it) \r\n\r\nPlease can any volunteers email me pronto(Stephen.Brown@uhbristol.nhs.uk) and I will forward the proposal and a response template.\r\n\r\nThanks,\r\nSteve\r\n\r\n\r\nFrom: Martin.Stephens@dh.gsi.gov.uk <Martin.Stephens@dh.gsi.gov.uk> \r\nTo: Robert.lowe@uea.ac.uk <Robert.lowe@uea.ac.uk>; mark.tomlin@suht.swest.nhs.uk <mark.tomlin@suht.swest.nhs.uk>; Liz Kay <Liz.Kay@leedsth.nhs.uk>; Beswick, Trevor <Trevor.Beswick@UHBristol.nhs.uk> \r\nCc: Brown Steve (NHS South West) \r\n\r\nSubject: Mixing medicines \r\n\r\nDear all, \r\n\r\nFollowing the legislation change and NPC guidance re mixing medicines, I have been aware of concerns re practicalities of implementing the requirements in practice -- based on each prescription having the appropriate details. Steve Brown very helpfully drafted a report whch was discussed at the SHA Leads meeting with DH. Steve and I then met with MHRA colleagues and, based on that conversation and subsequent exchanges, Steve prepared a proposed guide for implementation. \r\n\r\nSteve and I believe we have captured MHRA advice whilst giving flexibility to implement. But before going more widely we thought it wise to test on a limited basis. \r\n\r\nProposals are attached, along with a feedback form which Steve has kindly agreed to receive back from you to collate. \r\nFor me there are two key questions - does the attached guide help implementation? does it remain within the law? of course MHRA will arbitrate on the latter. \r\n\r\nRob, would you have a look & test QA opinion? \r\nLiz, perhaps worth running past ATHP? \r\nMark, can you discuss with UKCPA intensive care colleagues? \r\nTrevor, your scrutiny would be helpful too. \r\n\r\nFeedback to Steve by 9th December would be very helpful. \r\n\r\nthanks \r\n\r\nMartin \r\n\r\n\r\nMartin Stephens\r\nNational Clinical Director for Hospital Pharmacy\r\nDepartment of Health\r\nSkipton House\r\n80 London Road\r\nLONDON SE1 6LH\r\n\r\nTel No. 020 7972 5516\r\nE-Mail:  Martin.Stephens@dh.gsi.gov.uk \r\n\r\n', 0, '2011/11/18', '18:25:53', 39, '0'),
(48, 'Brighton - 17/11/2011', 'Agenda and presentations are now uploaded to the website together with sponsorship information.  Benchmarking results will follow shortly.\r\n\r\nRegards\r\n\r\nHelen', 0, '2011/12/09', '14:53:56', 6, '0'),
(49, 'Medicines Act Consolidation - section 10 (7) WDL', 'I have been in touch with the MHRA re a drafting group they are setting up for the wholesale dealing section 10 (7) of the Medicines Act consolidation, and have been invited to nominate an ATHP representative; I have requested ToR; clearly would be good for somebody from our ranks to volunteer so please let me know asap if you are interested; (for info there are 2 other NHS Pharmacists involved - David Miller from Sunderland and Sally Tomlin from Salisbury)\r\nThanks, \r\nSteve \r\n\r\n \r\n\r\n', 0, '2012/02/02', '08:25:45', 39, '0'),
(50, 'NHS Confederation email re EU Consultation: requirements for Hospital pharmacies to combat counterfeit medicines', 'You may have had sight of this email from the NHS Confederation; Andrew Davies has been in correspondence with them and has been providing expert opinion (as he also chairs the UK Pharmacy Business Technology Group for the Commercial Medicines Unit); am forwarding as the deadline is before our York meeting.  I''m sure Andrew would be grateful to be copied in to any comments;\r\nSteve\r\n\r\n\r\nDear Colleagues,\r\n\r\nThe European Commission is in the process of developing new measures to prevent counterfeit drugs from entering the supply chain. Your expertise as Pharmacists within the NHS would be invaluable in helping the NHS European office to influence this process.\r\n\r\nThe work currently underway includes finding effective ways of identifying falsified medicines, and systems to improve checks and controls on prescription-only medicines (and some non-prescription medicines) as they are dispensed to the public .\r\n\r\nâ€˜Unique identifiersâ€™ which contain a randomised serialisation number such as linear barcodes, 2D barcodes or radio-frequency identification (RFID) are being proposed as safety features within this process. They will be placed on the packaging of individual medicinal products so that when a product is dispensed the number contained within the unique identifier can be checked against a repositories system for verification. This process is intended to guarantee a medicinal productâ€™s authenticity, to facilitate traceability of a product and to help determine where a medicinal product has been tampered with. \r\n\r\nThe European Commission is currently seeking feedback on how best to introduce this new system and the NHS European Office would welcome your views on a number of the issues raised in the consultation paper. For example:\r\n\r\nÂ·         Should all manufacturers of medicinal products use one single unique identifier, or should they be able to choose whether to use linear barcodes, 2D barcodes or RFID?\r\n\r\nÂ·         At what point in the dispensing system should the serialisation number of the product should be checked? Should this be at the point of dispensation alone, at the point of dispensation with random verification at the level of wholesale distributors, or at the point of dispensation with systematic verification by wholesale distributors?\r\n\r\nWe are particularly interested to hear from hospital pharmacists who would be able to inform us of the practical and financial implications of the various proposals put forward by the Commission. For example:\r\n\r\nÂ·         Do NHS hospital pharmacies currently have the technology to read linear barcodes, 2D barcodes and radio-frequency identification?\r\n\r\nÂ·         What could the potential costs be of having to introduce such systems? \r\n\r\nÂ·         Are there other issues, such as administrative burden or pressure on human resources which should be taken into account when regulating this new system?\r\n\r\nIt should be noted that whatever the Commission ultimately decides as a result of the consultation, will become law in 2014 and hospital pharmacies will be obliged to comply.\r\n\r\nPlease find the full consultation paper attached. We would welcome views in particular on Consultation Topic Number 2 (questions 6 and 7).\r\n\r\nAny submissions should be sent to me by 5pm 23 April 2012.\r\n\r\nPlease do not hesitate to contact me for further information, or to pass this issue on to colleagues.\r\n\r\nKind regards,\r\n\r\nJenny-Lee\r\n\r\nJenny-Lee Spencer\r\n\r\nSenior European Policy Manager - NHS European Office\r\n\r\nDDI: +32 (0)2 227 6448\r\n\r\nwww.nhsconfed.org/europe\r\n\r\nwww.nhsconfed.org/2012\r\n\r\n --------------------------------------------------------------------------------\r\nThe NHS Confederation\r\nRegistered Address:\r\n29, Bressenden Place\r\nLondon\r\nSW1E 5DD\r\n', 0, '2012/03/27', '08:22:40', 39, '0'),
(51, 'IV Flush with 0.9% Sodium Chloride compliance with leagl and professional standards of administration of medicines', '\r\nWithin NHS Greater Glasgow and Clyde we have had protracted discussions over some time about the governance arrangements in place for the administration of "IV flush" solutions to patients after IV cannula insertion or during IV medicine administration. Sodium Chloride (and glucose, if used) are classified as POMs in these instances, and therefore should only be administered to patients in accordance with certain specification (e.g. written direction of a Doctor, PGD, PSD etc, as stated in the NMC Medicines Management standards).  A potential solution is to utilise the pre filled flush devices that are categorised as medical devices (CE marked), not medicines - but within our organisation the increased cost of this would be significant.  Nursing, pharmacy, and governance leads have acknowledged that the current situation, whereby flush solution are administered routinely across the organisation but are not prescribed or recorded, is a governance problem as it contravenes our own Safe and Secure Handling of Medicines policy and NMC guidance.  Whilst the risk of serious incident with a flush administration has been assessed as low, the implications for the individual and organisation if an incident occurred could be very serious.  We have explored various options but have yet to find a viable, practical solution that will allow patients to receive flush solution sin a timely manner, where administration would not  generate a significant recording  , but still satisfy legal and governance requirements.  Has anyone considered this and found a solution?\r\n', 0, '2012/03/29', '14:22:49', 35, '0'),
(52, 'IV Flush with 0.9% Sodium Chloride compliance with leagl and professional standards of administration of medicines', 'Hi Norman\r\n\r\nWe have considered the "risks" and included the following in our Medicines Management policy\r\n"Intravenous 0.9% Sodium Chloride flushes for the purpose of: cannula insertion; between and after IV drug or fluid administration; maintenance of patency of cannulae or CVADs do NOT require a prescription when given by a registered practitioner. NB within a community setting it remains best practice to obtain a valid prescription."\r\nOur view is that this is the most pragmatic and lowest risk option\r\nAndrew\r\n\r\nAndrew Davies\r\nNorth Bristol\r\n29th March 2012', 51, '2012/03/29', '15:03:19', 8, '0'),
(53, 'IV Flush with 0.9% Sodium Chloride compliance with leagl and professional standards of administration of medicines', 'Apologies for delay responding. We moved to BD ''posiflush'' devices last year (small overall cost to organisation), but very well received and no issues have been raised regards inappropriate use e.g. reconstitution of medicines. These are not prescribed but administered by staff under a core PGD.\r\n\r\nTom Gray\r\nDerby Hospitals\r\n 26 April 2012\r\n', 51, '2012/04/26', '12:24:14', 45, '0'),
(54, 'A few ATHP messages to read', 'Greetings; a few issues to flag up:\r\n\r\n1.  Benchmarking\r\nAvid readers of Clinical Pharmacist will have seen (June 2012 page 153) a conversation around benchmarking of medicines reconciliation following on from Clare Howardâ€™s presentation at the NICE conference.  This picked up the work we discussed in York and document how ATHP will be piggybacking onto Clareâ€™s South Central benchmarking process (or to be more accurate, and to quote: â€˜a national programme of data collection around medicines reconciliation is about to start with the help of ATHP and SC SHAâ€™).  This is still being teed up and I am awaiting further instructions from Clareâ€™s team.  Iâ€™m just flagging it up now for those who missed the York meeting; it would be good if we can all start as a pack and avoid delays.  Further info to follow.\r\n  \r\n2.  NHS Commissioning Board\r\nI took part in a meeting of the NHS CB and the world of Pharmacy re â€˜developing agreements with professional partners for clinical advice and leadershipâ€™.  Part of Keith Ridgeâ€™s role is based in the NHS CB and the RPS needs to take on an important co-ordinating function in enabling the provision of advice.  The RPS has formal partner organisations eg UKCPA, UKMI etc but ATHP is not in this group. I believe we should have a less formal memorandum of understanding with the RPS so that our advice can be fed in where appropriate.  They would not be representing us but co-ordinating the provision of advice.  I will follow this up with the RPS who are keen to engage, so shout if this will cause you to lose any sleep.  \r\n\r\n3. Modernising Pharmacy Careers â€“ stakeholder event\r\nThe MPC review of post-registration career development of pharmacists and pharmacy technicians has invited an ATHP representative to one of two stakeholder events (Friday 13th July in London or Monday 16th July in Manchester).  I unfortunately have commitments on both dates and will not be able to attend.  Is anyone keen and able to attend, engage and feed back?  Please email me at Stephen.Brown@uhbristol.nhs.uk and I will forward the details.\r\n\r\n4. November meeting\r\nThanks to Tania for forwarding the proposed dates for the November meeting in the West Midlands; please respond as requested so we can firm up the dates and have someting to look forward to now the week of summer has finished.\r\n\r\nThanks\r\nSteve \r\n', 0, '2012/06/06', '19:06:08', 39, '0'),
(55, 'ATHP June 2012', 'Greetings \r\n\r\nUpdate on a few issues:\r\n\r\n1. NHS Commissioning Board\r\n\r\nFollowing my last email there was resounding approval to work more closely with the RPS and recognise their important co-ordinating function in enabling the provision of advice to the NHS CB; I have a telephone appointment scheduled with Catherine Duggan to follow this up.\r\n(The RPS are also interested in publishing the â€˜Mixing of Medicinesâ€™ guidance that I circulated so I will be following that up with CD as well) \r\n\r\n2. RPS Standards\r\n\r\nThe RPS have requested that an ATHP representative joins the steering group on the next phase of work to support implementation of the Hospital Standards. The core remit of the steering group will be to help scope and develop the implementation programme and provide input into key decisions. \r\nI had a search for an eminent member who would be well placed for contributing to this steering group, having been engaged with the advisory group but not leading up one of the development sites; Tony West fitted the bill and has agreed to do this, so thanks Tony.  \r\n(Can we also note our thanks to Liz Kay for her role on the steering group for the publication of the standards as that was a job well done)  \r\n \r\n3. Modernising Pharmacy Careers stakeholder event\r\n(see my last email) Malcolm Partridge has volunteered to represent ATHP at the above event, so thanks Malcolm\r\n\r\n4. Benchmarking update\r\n\r\nTo recap, ATHP will be piggybacking onto Clare Howards South Central benchmarking process, so further instructions for those who have not yet engaged are below; the input is managed by Craig Robb from NHS Couth Central so he is your main contact point:\r\n\r\nEach trust that has submitted data so far has either sent an e-mail indicating the number of charts and the number of meds rec completed; or a copy of their own internal patient safety circular which contains this information.  \r\nThe audits are based on taking a sample of patients, or their charts, on one day of the week each month (a different day each month) and counting how many of the sample have had medicines reconciliation completed to stage 1 (the point where any discrepancies between the medicines prescribed on admission and those the patient was taking prior to admission have been highlighted by a member of the pharmacy staff) within 24 hours of admission (as defined below â€“ for simplicity 24 hours has come to mean the end of the day following the day of admission).  \r\nThe meds reconciliation info is usually gathered from at least two independent sources â€“ the patient, the patientâ€™s relatives, friends or carers, the patients GP, the medicines brought in by the patient and/or a specific medicines history database. \r\nAny investigation or discussion between the pharmacist and the doctor about whether a discrepancy is intentional or not is downstream of this audit point.  \r\nThe size of the sample is entirely up to you but the key is to ensure that it is representative of your trust.  Having said that, we would always exclude outpatients and paediatrics, as the NICE guidelines are about inpatients >16 yrs of age.  Some trusts exclude mental health patients and obstetrics too.\r\nCraig Robb\r\nProject Support Officer\r\nNHS South of England\r\nTel: 01635 275 568\r\nCraig.Robb@southcentral.nhs.uk\r\n\r\n5. And finally\r\nThe RPS have received a request regarding pharmacy input into the work of updating the British Society of Rheumatology guidelines for the monitoring of disease modifying drugs http://www.rheumatology.org.uk/includes/documents/cm_docs/2009/d/diseasemodifying_antirheumatic_drug_dmard_therapy.pdf .\r\nThis is being co-ordinated through the Royal Free Hospital.  If you have anyone with expertise in this area who would like to be involved please let me know and I can provide contact details.\r\n\r\n\r\nI think thatâ€™s it for now, thanks\r\nSteve\r\n(Stephen.Brown@uhbristol.nhs.uk)\r\n\r\n \r\n', 0, '2012/06/27', '17:59:53', 39, '0'),
(56, 'ATHP: Reducing medicines waste', 'Greetings from Sunny Sheffield!\r\n\r\nRe: Action Plan of the Steering Group on Improving the Use of Medicines (for better outcomes and reduced waste)\r\n"3.7 Every Trust should complete a snapshot (one week) audit of medicines returned to the pharmacy"\r\n\r\nDoes anyone have an audit tool/spreadsheet/recording form that they''d be willing to share please?\r\n\r\nAlso, do you have a summary of results that we could benchmark against? Even without analysing the returns contents and despite the marvellous work we''re already doing (dispensing for discharge, reuse of PODS etc) we know we know we''ve still got a major problem on our hands (circa 6 tonnes per annum!)\r\n\r\nThanks\r\n\r\nDamian Child\r\nChief Pharmacist\r\nSheffield Teaching Hospitals NHS Foundation Trust\r\ndamian.child@sth.nhs.uk\r\nTel 0114 271 4164 (Northern General Hospital)\r\nTel 0114 271 2658 (Royal Hallamshire Hospital)\r\n\r\n', 0, '2013/07/12', '13:25:13', 14, '0'),
(57, 'Leeds, rebalancing etc', 'Dear Colleagues\r\n\r\nCan I thank Liz again for organising the Leeds meeting last week as it was an excellent, enjoyable and challenging meeting with a lot of valuable content.  (Also thanks to Lyndal for the practical arrangements). The slides should be up on the website soon, both for those who attended and those who couldnâ€™t make it.\r\n\r\nThe next meeting is scheduled for Belfast in the Spring so (assuming thatâ€™s still ok) we will be in touch with Mike to get some provisional dates in the diary.  Some advanced requests were the discussion of outsourcing / insourcing and the application of Define.\r\n\r\nThanks to David Campbell who volunteered as the next ATHP chair so I am now passing the chairmanship in his direction!\r\n\r\nAnd thanks to Pippa for her work this year, plus a reminder for any aspiring volunteers that she is keen to pass her role on.\r\n\r\nA few things:\r\n1. Business from Leeds\r\nWe do need to keep track of a number of issues from last weekâ€™s meeting, however, as we were encouraged by Keith (and in some of the other sessions) to develop a number of position papers as below:\r\n- The spread of antimicrobial management to primary care to combat resistance\r\n-  Medicines optimisation and vulnerable patients\r\n- The teaching hospital perspective on â€˜shaping Pharmacy for the futureâ€™\r\n- Consultant Pharmacists â€“ where next?\r\nPlease pull together local information and examples to populate a template shortly.\r\n\r\nThere were a couple of other issues that I raised, one being the awareness of which trusts are in the AUKUH and the benchmarking data being provided (some about the Pharmacy service!).  Have a look on the following links to see if you are in this.\r\nhttp://www.aukuh.org.uk/index.php/members/member-organisations\r\n\r\nThey do have some useful narrative that we can borrow as well eg the role of the University Hospital\r\nhttp://www.aukuh.org.uk/index.php/documents\r\nand benchmarking data about our staffing and skillmix.\r\n\r\n\r\n2. Rebalancing legislation and regulation\r\n\r\nToday I have been representing ATHP at the Partners Forum for â€˜Rebalancing Medicines Legislation and Pharmacy Regulationâ€™. \r\n\r\nJust to recap, the five key areas of the work programme are as below:\r\n\r\na.  Dispensing Errors: Review the pertinent criminal offences in relation to regulated pharmacy professions, operating from regulated pharmacy premises.  The threat of criminal sanction is widely believed to hinder the reporting of errors and therefore the learning from such errors.  There is evidence that reporting and learning from errors supports patient safety. \r\nb.  Responsible Pharmacist: Government policy is to avoid, where possible, detailed legislation to regulate professional activity.  The responsible pharmacist regulations have been subject to an evaluation, commissioned by RPS and PFPSNI in 2011, and more recently, have been examined as part of the Red Tape Challenge for Medicines.  The board is asked to examine the scope for reducing the level of detail within the Regulations and whether some of the enabling powers to make regulations remain necessary. \r\nc. Pharmacy Superintendent: The board is asked to examine the legislative and regulatory framework in terms of the effectiveness of components of the system, which support patient safety, not only in relation to the responsible pharmacist, but also the role of superintendent in order to provide greater clarity of role, accountability and competence. \r\nd. Hospital Pharmacy: The board will also consider regulatory arrangements for hospital pharmacies. These could underpin high quality hospital pharmacy services and enable the removal of the criminal sanction for dispensing errors for pharmacy professionals in hospitals.  Provision of medicines to patients in hospital does not, for the most part require registration of pharmacy premises, although all hospital pharmacy professionals are subject to professional regulation in the normal way. \r\ne. Pharmacy Supervision: Building on the foundations above, the Board is asked to develop proposals on supervision. These should identify and review the medicines legislation which is considered to restrict the full use of the skills of registered pharmacists and registered pharmacy technicians or impede the deployment of modern technologies or put unnecessary obstacles in the way of new models of pharmacy service.\r\nâ€ƒ\r\n\r\nThe partners forum brings Ken Jarrold to the lecturn with Jeannette Howe presenting the Programme Boardâ€™s recommendations, and the Board listening to the engagement.  The ToR are attached for info.\r\nThe â€˜dispensing errorsâ€™ partners forum was a couple of months ago and you should have received my feedback in a previous email.\r\nTodayâ€™s forum was about superintendent pharmacists and responsible pharmacists (and they also squeezed in Pharmacy owners).  I don''t think i can attach my notes from the ATHP website so i''ll respond to this with a separate email with the attachments of my notes and the briefing paper that was circulated, so if you are interested have a read of the briefing paper first in order to make some sense of my notes.  Am happy to answer any questions.\r\n\r\nSteve\r\n', 0, '2013/12/02', '19:25:55', 39, '0'),
(58, 'Test ', 'Dear all \r\nHave a good new year \r\nJust testing the messaging service ont he website!\r\nPippa', 0, '2013/12/31', '09:01:27', 4, '0'),
(59, 'Test 2', 'This is a test.', 0, '2014/01/01', '17:27:10', 1, '1'),
(60, 'Test 2', 'This is another test.', 0, '2014/01/01', '17:29:06', 1, '1'),
(61, 'Test 2', 'This is another test.', 0, '2014/01/01', '17:31:07', 1, '1'),
(62, 'Test 2', 'This is another test.', 0, '2014/01/01', '17:32:39', 1, '1'),
(63, 'Test 2', 'This is another test.', 0, '2014/01/01', '17:33:46', 1, '1'),
(64, 'Test 2', 'This is another test.', 0, '2014/01/01', '17:35:37', 1, '1'),
(65, 'Test 2', 'This is a test', 0, '2014/01/01', '17:37:55', 1, '1'),
(66, 'Test 2', 'Test', 0, '2014/01/01', '17:39:41', 1, '1'),
(67, 'Test 2', 'This is another test.', 0, '2014/01/01', '17:40:32', 1, '1'),
(68, 'Test 2', 'This is a test.', 0, '2014/01/01', '17:42:18', 1, '1'),
(69, 'Test Message', 'This is a test message to all users to check that an update to the email system is working as required. There is no need to respond to this email.', 0, '2014/01/01', '17:45:38', 1, '1'),
(70, 'In-tariff drug savings', 'Dear all\r\n\r\nI have an in-tariff drugs savings target of Â£200k (in year) for 2014/15, which is about 1% of our in-tariff spend. Included within that are price reductions through contract changes and any schemes to make savings by reducing/changing prescribing of in-tariff drugs.\r\n\r\nMy DoF wants to know how this target compares to other Trusts. Please could you let me know what agreements you have in your organisations.\r\n\r\nMany thanks\r\nSue\r\n\r\nSue Ladds\r\nChief Pharmacist\r\nUniversity Hospital Southampton NHS Foundation Trust\r\n\r\n023 8120 4458\r\nsue.ladds@uhs.nhs.uk\r\n', 0, '2014/03/31', '16:23:59', 70, '0'),
(71, 'Test', 'This is a test', 0, '2014/07/06', '18:47:23', 1, '0'),
(72, 'Test', 'This is a test', 0, '2014/07/06', '18:47:42', 1, '0');

-- --------------------------------------------------------

--
-- Table structure for table `messagescategorys`
--

CREATE TABLE `messagescategorys` (
  `IDLNK` int(11) NOT NULL AUTO_INCREMENT,
  `MessageIDLNK` int(11) NOT NULL,
  `CategoryIDLNK` int(11) NOT NULL,
  `Deleted` varchar(1) NOT NULL,
  PRIMARY KEY (`IDLNK`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=43 ;

--
-- Dumping data for table `messagescategorys`
--

INSERT INTO `messagescategorys` (`IDLNK`, `MessageIDLNK`, `CategoryIDLNK`, `Deleted`) VALUES
(1, 3, 2, '0'),
(2, 4, 1, '0'),
(3, 5, 2, '0'),
(4, 5, 1, '0'),
(5, 18, 2, '0'),
(6, 40, 2, '0'),
(7, 40, 1, '0'),
(8, 41, 2, '0'),
(9, 46, 1, '0'),
(10, 47, 1, '0'),
(11, 48, 1, '0'),
(12, 49, 1, '0'),
(13, 50, 1, '0'),
(14, 51, 1, '0'),
(15, 54, 1, '0'),
(16, 55, 1, '0'),
(17, 56, 1, '0'),
(18, 57, 1, '0'),
(19, 58, 2, '0'),
(20, 58, 1, '0'),
(21, 59, 2, '0'),
(22, 59, 1, '0'),
(23, 60, 2, '0'),
(24, 60, 1, '0'),
(25, 61, 2, '0'),
(26, 61, 1, '0'),
(27, 62, 2, '0'),
(28, 62, 1, '0'),
(29, 63, 2, '0'),
(30, 63, 1, '0'),
(31, 64, 2, '0'),
(32, 64, 1, '0'),
(33, 65, 2, '0'),
(34, 65, 1, '0'),
(35, 66, 2, '0'),
(36, 66, 1, '0'),
(37, 67, 2, '0'),
(38, 67, 1, '0'),
(39, 68, 2, '0'),
(40, 68, 1, '0'),
(41, 69, 2, '0'),
(42, 69, 1, '0');

-- --------------------------------------------------------

--
-- Table structure for table `notices`
--

CREATE TABLE `notices` (
  `IDLNK` int(11) NOT NULL AUTO_INCREMENT,
  `Title` varchar(255) NOT NULL,
  `Notice` text NOT NULL,
  `DateAdded` varchar(10) NOT NULL,
  `PostedByIDLNK` int(11) NOT NULL,
  `Deleted` varchar(1) NOT NULL,
  PRIMARY KEY (`IDLNK`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `notices`
--

INSERT INTO `notices` (`IDLNK`, `Title`, `Notice`, `DateAdded`, `PostedByIDLNK`, `Deleted`) VALUES
(1, 'Test Notice', 'Test Notice', '2010/10/16', 1, '0'),
(2, 'Event Test Event added to ATHP website.', '<p>A new event has been edited on the ATHP website. Details are shown below.</p><dl><dt>Event:</dt><dd>Test Event</dd><dt>Details:</dt><dd>Details</dd><dt>Location:</dt><dd>Location</dd><dt>Date &amp; Time:</dt><dd>15/05/2010 15:00</dd><dt>Duration:</dt><dd>2 Hours</dd></dl><p>You can view this event in the ATHP <a href="http://www.athp.org.uk/events.php">website calender</a>.</p>', '2010/10/16', 1, '1'),
(3, 'Document Comparison - Developing Pharmacy Careers.doc added to ATHP website.', '<p>A new document has been added to the ATHP website. Details are shown below.</p><dl><dt>Filename</dt><dd><a href="http://www.athp.org.uk/downloads.php?did=64">Comparison - Developing Pharmacy Careers.doc</a></dd><dt>Description</dt><dd></dd></dl><p>You can download the file by clicking the filename and logging into the ATHP website.</p>', '2011/07/27', 6, '1'),
(4, 'Document 2011-06-30 : Minutes of Meeting.doc added to ATHP website.', '<p>A new document has been added to the ATHP website. Details are shown below.</p><dl><dt>Filename</dt><dd><a href="http://www.athp.org.uk/downloads.php?did=65">2011-06-30 : Minutes of Meeting.doc</a></dd><dt>Description</dt><dd></dd></dl><p>You can download the file by clicking the filename and logging into the ATHP website.</p>', '2011/08/09', 6, '1'),
(5, 'Document Benchmarking - Analysis.xls added to ATHP website.', '<p>A new document has been edited on the ATHP website. Details are shown below.</p><dl><dt>Filename</dt><dd><a href="http://www.athp.org.uk/downloads.php?did=85">Benchmarking - Analysis.xls</a></dd><dt>Description</dt><dd></dd></dl><p>You can download the file by clicking the filename and logging into the ATHP website.</p>', '2011/12/13', 6, '1');

-- --------------------------------------------------------

--
-- Table structure for table `noticescategorys`
--

CREATE TABLE `noticescategorys` (
  `IDLNK` int(11) NOT NULL AUTO_INCREMENT,
  `NoticeIDLNK` int(11) NOT NULL,
  `CategoryIDLNK` int(11) NOT NULL,
  `Deleted` varchar(1) NOT NULL,
  PRIMARY KEY (`IDLNK`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `noticescategorys`
--

INSERT INTO `noticescategorys` (`IDLNK`, `NoticeIDLNK`, `CategoryIDLNK`, `Deleted`) VALUES
(1, 1, 2, '0'),
(2, 1, 1, '0'),
(3, 2, 2, '0'),
(4, 2, 1, '0'),
(5, 3, 2, '0'),
(6, 3, 1, '0'),
(7, 4, 2, '0'),
(8, 4, 1, '0'),
(9, 5, 1, '0');

-- --------------------------------------------------------

--
-- Table structure for table `pages`
--

CREATE TABLE `pages` (
  `PageID` int(11) NOT NULL AUTO_INCREMENT,
  `Title` varchar(255) NOT NULL,
  `URL` varchar(100) NOT NULL,
  `Tags` varchar(255) NOT NULL,
  `Content` text NOT NULL,
  `ParentPageID` int(11) NOT NULL,
  `Private` tinyint(1) NOT NULL,
  `Deleted` tinyint(1) NOT NULL,
  PRIMARY KEY (`PageID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `positions`
--

CREATE TABLE `positions` (
  `PositionIDLNK` int(11) NOT NULL AUTO_INCREMENT,
  `Position` varchar(255) NOT NULL,
  `DisplayOrder` int(11) NOT NULL,
  `Deleted` varchar(1) NOT NULL,
  PRIMARY KEY (`PositionIDLNK`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=16 ;

--
-- Dumping data for table `positions`
--

INSERT INTO `positions` (`PositionIDLNK`, `Position`, `DisplayOrder`, `Deleted`) VALUES
(1, 'Test Position 1', 6, '0'),
(2, 'Clinical Director of Pharmacy', 14, '0'),
(3, 'Director of Pharmacy', 13, '0'),
(4, 'Chief Pharmacist', 12, '0'),
(5, 'Clinical Director of Pharmacy Services', 7, '0'),
(6, 'Director', 11, '0'),
(7, 'Director of Pharmaecutical Services', 10, '0'),
(8, 'Head of Pharmacy', 9, '0'),
(9, 'Director of Medicines Management', 8, '0'),
(10, 'Director of Pharmacy & Therapy Services', 4, '0'),
(11, 'Clinical Director - Medicines Management', 3, '0'),
(12, 'National Clinical Director for Hospital Pharmacy', 1, '0'),
(13, 'Lead Pharmacist Acute Services & Innovation', 2, '0'),
(14, 'Deputy Chief Pharmacist', 5, '0'),
(15, 'N/A', 15, '0');

-- --------------------------------------------------------

--
-- Table structure for table `sections`
--

CREATE TABLE `sections` (
  `IDLNK` int(11) NOT NULL AUTO_INCREMENT,
  `GroupIDLNK` int(11) NOT NULL,
  `Section` varchar(255) NOT NULL,
  `Description` text NOT NULL,
  `Deleted` varchar(1) NOT NULL,
  PRIMARY KEY (`IDLNK`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=25 ;

--
-- Dumping data for table `sections`
--

INSERT INTO `sections` (`IDLNK`, `GroupIDLNK`, `Section`, `Description`, `Deleted`) VALUES
(1, 1, 'Test Section', '', '0'),
(2, 2, 'Constitution', '', '0'),
(3, 3, 'Presentations', '', '1'),
(4, 3, '2010 November - London', '', '0'),
(5, 3, 'Agendas & Minutes', '', '1'),
(6, 6, 'test', '', '1'),
(7, 6, 'Consultation Responses - Various', '', '0'),
(8, 7, 'Comparisons', '', '0'),
(9, 3, '2010 April - Newcastle ', '', '0'),
(10, 3, '2009 November - Bristol ', '', '0'),
(11, 3, '2009 May - Glasgow', '', '0'),
(12, 3, '2011 June - Leicester ', '', '0'),
(13, 7, 'Comparison Template', '', '0'),
(14, 4, 'Annual Reports', '', '0'),
(15, 5, 'Medicines Management Strategies', '', '0'),
(16, 7, 'General Information', '', '0'),
(17, 8, 'Benchmarking Criteria', '', '0'),
(18, 3, '2011 November  - Brighton', '', '0'),
(19, 2, 'Sponsorship', '', '0'),
(20, 3, '2012 April - York', '', '0'),
(21, 9, 'Presentations', '', '1'),
(22, 3, '2012 November Birmingham', '', '0'),
(23, 3, '2013 April London', '', '0'),
(24, 3, '2013 November, Leeds', 'ATHP Autumn meeting ', '0');

-- --------------------------------------------------------

--
-- Table structure for table `sectionusercategorys`
--

CREATE TABLE `sectionusercategorys` (
  `IDLNK` int(11) NOT NULL AUTO_INCREMENT,
  `SectionIDLNK` int(11) NOT NULL,
  `UserCategoryIDLNK` int(11) NOT NULL,
  PRIMARY KEY (`IDLNK`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `sectionusercategorys`
--

INSERT INTO `sectionusercategorys` (`IDLNK`, `SectionIDLNK`, `UserCategoryIDLNK`) VALUES
(1, 14, 1),
(2, 14, 2),
(3, 14, 1),
(4, 14, 2),
(5, 14, 1),
(6, 14, 8),
(7, 14, 9),
(8, 2, 2),
(9, 2, 1),
(10, 2, 2),
(11, 2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `sites`
--

CREATE TABLE `sites` (
  `IDLNK` int(11) NOT NULL AUTO_INCREMENT,
  `TrustIDLNK` int(11) NOT NULL,
  `Name` varchar(250) NOT NULL,
  `AddressLine1` varchar(250) NOT NULL,
  `AddressLine2` varchar(250) NOT NULL,
  `Town` varchar(250) NOT NULL,
  `Postcode` varchar(10) NOT NULL,
  `Telephone` varchar(20) NOT NULL,
  `Fax` varchar(20) NOT NULL,
  `Deleted` varchar(1) NOT NULL,
  PRIMARY KEY (`IDLNK`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=52 ;

--
-- Dumping data for table `sites`
--

INSERT INTO `sites` (`IDLNK`, `TrustIDLNK`, `Name`, `AddressLine1`, `AddressLine2`, `Town`, `Postcode`, `Telephone`, `Fax`, `Deleted`) VALUES
(1, 1, 'Test Site 1', 'Somewhere', '', 'Sometown', 'SOME', '012345 678910', '', '0'),
(2, 2, 'ATHP', 'Beckett Street', '', 'Leeds', 'LS9 7TF', '0113 2064100', '', '1'),
(3, 3, 'Royal Liverpool and Broadgreen University Hospitals NHS Trust', 'Prescot Street', '', 'Liverpool', 'L7 8XP', '01752 431237', '', '0'),
(4, 4, 'Southmead Hospital', 'Westbury on Trym,', '', 'Bristol', 'BS10 5NB', '0117 3235440', '', '0'),
(5, 5, 'Hammersmith Hospital ', 'Du Cane Road ', '', 'London', 'W12 0HS', '07986 357097', '', '0'),
(6, 6, 'Queen Elizabeth Hospital', 'Queen Elizabeth Medical Centre', 'Edgbaston', 'Birmingham', 'B15 2TH', 'TBC', '', '0'),
(7, 7, 'Norfolk and Norwich University Hospitals NHS Trust', 'Colney Lane', '', 'Norwich', 'NR4 7UY', 'TBC', '', '0'),
(8, 8, 'King''s College Hospital NHS Foundation Trust', 'Denmark Hill', '', 'London', 'SE5 9RS', 'TBC', '', '0'),
(9, 9, 'St George''s Healthcare NHS Trust', 'Blackshaw Road', 'Tooting', 'London', 'SW17 0QT', 'TBC', '', '0'),
(10, 10, 'Northern General Hospital', 'Herries Road', '', 'Sheffield', 'S5 7AU', 'TBC', '', '0'),
(11, 11, 'University Hospital of Wales', 'Heath Park', '', 'Cardiff', 'CF14 4XW', '02920 742995', '', '0'),
(12, 12, 'Hull Royal Infirmary', 'Anlaby Road', '', 'Hull', 'HU3 2JZ', 'TBC', '', '0'),
(13, 13, 'The York Hospital', 'Wigginton ', '', 'York', 'YO31 8HE', 'TBC', '', '0'),
(14, 14, 'London Specialised Commissioning Group', 'E&SE England Specialist Pharmacy Services, 16th Floor, ', 'Portland House, Stag Place', 'London', 'SW15 5RS', 'TBC', '', '0'),
(15, 15, 'Debra Walker', 'Alder Hey Hospital', 'Eaton Road', 'Liverpool', 'L12 2AP', 'TBC', '', '0'),
(16, 16, 'Eimear McCusker', 'King Edward Building', 'Grosvenor Road', 'Belfast', 'BT12 6BA', '028 90636333', '028 90240899', '1'),
(17, 17, 'Addenbrooke''s Hospital', 'Hill''s Road', '', 'Cambridge', 'CB2 0QQ', '01223 217479 ', '', '0'),
(18, 18, 'Royal Sussex County Hospital', 'Eastern Road', '', 'Brighton', 'BN2 5BE', '01273 664932', '', '0'),
(19, 19, 'John Radcliffe Hospital ', 'Headley Way', 'Headington ', 'Oxford', 'OX3 9DU', 'TBC', '', '0'),
(48, 38, 'Pharmacy Department, Royal Brompton Hospital', 'Sydney Street', '', 'London', 'SW3 6NP', 'N/A', '', '0'),
(20, 20, 'University Hospital of South Manchester NHS Foundation Trust', 'Southmoor Road', 'Wythenshawe', 'Manchester', 'M23 9LT', '0161 9987070', '', '0'),
(21, 21, 'Salford Royal NHS Foundation Trust', 'Stott Lane', '', 'Salford', 'M6 8HD', 'TBC', '', '0'),
(22, 22, 'Chelsea and Westminster Healthcare NHS Trust', '369 Fulham Road', '', 'London', 'SW10 9NH', 'TBC', '', '0'),
(23, 24, 'University Hospital Aintree NHS Trust', 'Lower Lane', '', 'Liverpool ', 'L9 1AL', 'TBC', '', '0'),
(24, 25, 'Queens Medical Centre Campus', 'Derby Road', '', 'Nottingham', 'NG7 2UH', '0115 9709199', '', '0'),
(25, 26, 'University Hospital', 'Clifford Bridge Road', 'Coventry', 'West Midlands', 'CV2 2DX', '02476 966769', '', '0'),
(26, 23, 'Leeds General Infirmary', 'Great George Street', '', 'Leeds', 'LS1 3EX', '0113 3926290 PA', '', '0'),
(27, 27, 'Skipton House', '80 London Road', '', 'London ', 'SE1 6LH', '02380 798551/07777 4', '', '0'),
(28, 28, 'Antrim Hospital', '45 Bush Road', 'Antrim', 'County Antrim', 'BT41 2RL', '028 9442 400', '', '0'),
(29, 29, 'Newcastle Upon Tyne Hospitals NHS Foundation Trust', 'Freeman Road', 'High Heaton, Newcastle Upon Tyne', 'Tyne and Wear', 'NE7 7DN', '0191 2824220', '', '0'),
(30, 30, 'Pharmacy and Prescribing Unit, Victoria Infirmary', 'Queens Park House ', 'Langside Road', 'Glasgow', 'G42 9TY', '0141 2015337', '', '0'),
(31, 32, 'Derby City General Hospital', 'Uttoxeter Road', '', 'Derby', 'DE22 3NE', '01332 785562', '', '0'),
(32, 33, 'Bristol Royal Infirmary', 'Upper Maudlin Street', '', 'Bristol', 'BS2 8HW', '0117-3422772', '', '0'),
(33, 34, 'Birmingham Heartlands Hospital', 'Birmingham', '', 'West Midlands', 'B9 5SS', '0121 42 42446 ', 'B9 5SS ', '0'),
(34, 31, 'Royal Infirmary of Edinburgh', '51 Little France Crescent,', 'Old Dalkeith Road', 'Edinburgh', 'EH16 4SA', '0131 5361000', '', '0'),
(35, 35, 'North Tyneside General Hospital', 'Rake Lane', 'North Shields', 'Tyne & Wear', 'NE29 8NH', 'TBC', '', '0'),
(36, 36, 'Abertawe Bro Morgannwy', 'One Talbot Gateway, Baglan Energy Park,', 'Seaway Parade, Port Talbot', 'West Glamorgan', 'SA12 7BR', 'TBC', '', '0'),
(37, 40, 'Stuart Semple', 'The Royal London Hospital, Pathology & Pharmacy Building,', '80 Newark Street, Whitechapel,', 'London', 'E1 2ES', 'TBC', '', '1'),
(38, 41, 'Southampton University Hospital NHS Trust', 'Tremona Road', '', 'Southampton', 'SO16 6YD', 'TBC', '', '0'),
(39, 42, 'University Hospital of North Staffordshire NHS Trust', 'Princes Road', 'Stoke on Trent', 'Staffordshire', 'ST4 7LN', 'TBC', '', '0'),
(40, 43, 'Leicester General Hospital', 'Gwendolen Road', '', 'Leicester', 'LE5 4PW', 'TBC', '', '0'),
(41, 44, 'St Thomas'' Hospital', 'Westminster Bridge Road', '', 'London', 'SE1 7EH', 'TBC', '', '0'),
(42, 45, 'The Royal Free Hospital', 'Pond Street', '', 'London', 'NW3 2QG', 'TBC', '', '0'),
(43, 46, 'University College London Hospitals NHS Foundation Trust', '235 Euston Road', '', 'London', 'NW1 2BU', 'TBC', '', '0'),
(44, 16, 'King Edward Building', 'Grosvenor Road', '', 'Belfast', 'BT12 6BA', '028 90636333', '028 90240899', '0'),
(45, 37, 'Arrowe Park Hospital', 'Arrowe Park Road', 'Upton', 'Wirral', 'CH49 4PE', '0151 604 7464', '', '0'),
(46, 39, 'Manchester Royal Infirmary, Oxford Road, Manchester, M13 9WL', 'Oxford Road', '', 'Manchester', 'M13 9WL', '0161 276 1234', '', '0'),
(47, 40, 'The Royal London Hospital ', 'Pathology & Pharmacy Building,  80 Newark Street', 'Whitechapel', 'London ', 'E1 2ES', 'N/A', '', '0'),
(49, 47, 'King Edward Building', 'Grosvenor Road', '', 'Belfast', 'BT12 6BA', 'N/A', '', '0'),
(50, 48, 'Bradford Royal Infirmary', 'Duckworth Lane', '', 'Bradford', 'BD9 6RJ', 'BD9 6RJ', '', '0'),
(51, 49, 'The Royal Wolverhampton NHS Trust', 'Wednesfield Road', '', 'Wolverhampton', 'WV10 0QP', 'N/A', '', '0');

-- --------------------------------------------------------

--
-- Table structure for table `tags`
--

CREATE TABLE `tags` (
  `IDLNK` int(11) NOT NULL AUTO_INCREMENT,
  `Title` varchar(50) NOT NULL,
  `Deleted` bit(1) NOT NULL,
  PRIMARY KEY (`IDLNK`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=17 ;

--
-- Dumping data for table `tags`
--

INSERT INTO `tags` (`IDLNK`, `Title`, `Deleted`) VALUES
(1, 'yellow guide', '\0'),
(2, 'chapter 10', '\0'),
(3, '', '\0'),
(4, 'qcnw ', '\0'),
(5, 'report', '\0'),
(6, 'yellow', '\0'),
(7, 'guide', '\0'),
(8, 'two', '\0'),
(9, 'sdsc', '\0'),
(10, 'logo', '\0'),
(11, ' sdsc', '\0'),
(12, ' logo', '\0'),
(13, '  sdsc', '\0'),
(14, '  logo', '\0'),
(15, '   sdsc', '\0'),
(16, '   logo', '\0');

-- --------------------------------------------------------

--
-- Table structure for table `trusts`
--

CREATE TABLE `trusts` (
  `IDLNK` int(11) NOT NULL AUTO_INCREMENT,
  `Trust` varchar(200) NOT NULL,
  `Deleted` varchar(1) NOT NULL,
  PRIMARY KEY (`IDLNK`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=50 ;

--
-- Dumping data for table `trusts`
--

INSERT INTO `trusts` (`IDLNK`, `Trust`, `Deleted`) VALUES
(1, 'Test Trust 1', '0'),
(2, 'ATHP', '1'),
(3, 'Royal Liverpool and Broadgreen University Hospitals NHS Trust', '0'),
(4, 'North Bristol NHS Trust', '0'),
(5, 'Imperial College Healthcare NHS Trust', '0'),
(6, 'University Hospital Birmingham NHS Foundation Trust', '0'),
(7, 'Norfolk and Norwich University Hospital NHS Trust', '0'),
(8, 'King''s College Hospital NHS Foundation Trust', '0'),
(9, 'St George''s Healthcare NHS Trust', '0'),
(10, 'Sheffield Teaching Hospitals NHS Trust', '0'),
(11, 'Cardiff & Vale University Health Board', '0'),
(12, 'Hull and East Yorkshire Hospital NHS Trust', '0'),
(13, 'York Teaching Hospitals NHS Foundation Trust', '0'),
(14, 'London Specialised Commissioning Group', '0'),
(15, 'Royal Liverpool Children''s NHS Trust', '1'),
(16, 'The Royal Hospitals Belfast NHS Trust', '0'),
(17, 'Cambridge University Hospitals NHS Foundation Trust', '0'),
(18, 'Brighton and Sussex University Hospitals NHS Trust ', '0'),
(19, 'Oxford University Hospitals NHS Trust', '0'),
(20, 'University Hospital of South Manchester NHS Foundation Trust', '0'),
(21, 'Salford Royal NHS Foundation Trust', '0'),
(22, 'Chelsea and Westminster Healthcare NHS Trust', '0'),
(23, 'Leeds Teaching Hospitals NHS Trust', '0'),
(24, 'University Hospital Aintree NHS Trust', '0'),
(25, 'Nottingham University Hospitals NHS Trust', '0'),
(26, 'University Hospitals Coventry and Warwickshire NHS Trust', '0'),
(27, 'Department of Health', '0'),
(28, 'Northern Health and Social Care Trust', '0'),
(29, 'Newcastle upon Tyne Hospitals NHS Foundation Trust', '0'),
(30, 'NHS Greater Glasgow and Clyde', '0'),
(31, 'NHS Lothian Pharmacy Service', '0'),
(32, 'Derby Hospitals NHS Foundation Trust ', '0'),
(33, 'University Hospitals Bristol NHS Foundation Trust', '0'),
(34, 'Heart of England NHS Foundation Trust', '0'),
(35, 'Northumbria Healthcare NHS Foundation Trust', '0'),
(36, 'Abertawe Bro Morgannwy University Health Board', '0'),
(37, 'Wirral University Teaching Hospitals NHS Foundation Trust', '0'),
(38, 'Royal Brompton and Harefield NHS Foundation Trust', '0'),
(39, 'Central Manchester University Hospitals NHS Foundation Trust', '0'),
(40, 'Barts and The London NHS Trust', '0'),
(41, 'Southampton University Hospital NHS Trust', '0'),
(42, 'University Hospital of North Staffordshire NHS Trust', '0'),
(43, 'University Hospitals of Leicester NHS Trust', '0'),
(44, 'Guy''s and St Thomas'' NHS Foundation Trust', '0'),
(45, 'The Royal Free London NHS Trust', '0'),
(46, 'University College London Hospitals NHS Foundation Trust', '0'),
(47, 'Belfast Health and Social Care Trust', '0'),
(48, 'Bradford Teaching Hospitals NHS Foundation Trust', '0'),
(49, 'The Royal Wolverhampton NHS Trust', '0');

-- --------------------------------------------------------

--
-- Table structure for table `usercategorys`
--

CREATE TABLE `usercategorys` (
  `IDLNK` int(11) NOT NULL AUTO_INCREMENT,
  `Title` varchar(255) NOT NULL,
  `Deleted` varchar(1) NOT NULL,
  PRIMARY KEY (`IDLNK`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `usercategorys`
--

INSERT INTO `usercategorys` (`IDLNK`, `Title`, `Deleted`) VALUES
(1, 'ATHP Member', '0'),
(2, 'ATHP Associate', '0'),
(3, 'Test Group', '1'),
(4, 'Another group', '1'),
(5, 'Another group 2', '1'),
(6, 'Another group', '1'),
(7, 'Another group 2', '1'),
(8, 'Test Group 1', '0'),
(9, 'Test Group 2', '0');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `IDLNK` int(11) NOT NULL AUTO_INCREMENT,
  `Username` varchar(50) NOT NULL,
  `Password` varchar(255) NOT NULL,
  `Firstname` varchar(50) NOT NULL,
  `Surname` varchar(50) NOT NULL,
  `Email` varchar(255) NOT NULL,
  `Hospital` varchar(255) NOT NULL,
  `Userlevel` int(11) NOT NULL,
  `Deleted` tinyint(1) NOT NULL,
  PRIMARY KEY (`IDLNK`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=78 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`IDLNK`, `Username`, `Password`, `Firstname`, `Surname`, `Email`, `Hospital`, `Userlevel`, `Deleted`) VALUES
(1, 'WJProctor', 'a200cd2562afb2953c9b7e4a24fd6ebe', 'James', 'Proctor', 'james.proctor@wjps.co.uk', 'None', 3, 0),
(2, 'Test2', 'c2e100fb35a2da51224c9501f712766b', 'James', 'Proctor', 'sales@wjps.co.uk', 'None', 1, 0),
(3, 'LKay', '6c4247bd511f6acf74a5720fa47cc929', 'Liz', 'Kay', 'liz.kay@leedsth.nhs.uk', 'Leeds General Infirmary', 3, 0),
(4, 'PRoberts', '2246f8df596f4a540c3a87b1e0fa5f9e', 'Phillipa', 'Roberts', 'p.roberts3@nhs.net', 'Wirral University Teaching Hospital', 3, 0),
(5, 'MParton-Murphy', '56e9bcab7194ee95fb7ea2ac932475b3', 'Marsha', 'Parton-Murphy', 'MParton-Murphy@nhs.net', 'Wirral University Teaching Hospital NHS Foundation Trust', 3, 1),
(6, 'HSmith', 'dd6c8037a5b85af524342ff91b83b912', 'Helen', 'Smith', 'athpadmin@virginmedia.com', 'Leeds Teaching Hospital', 3, 1),
(7, 'AEwing', 'defbb5d5ea56182e87f4b4d21b40027e', 'Alison', 'Ewing', 'alison.ewing@rlbuht.nhs.uk', 'Royal Liverpool and Broadgreen University Hospitals NHS Trust', 1, 0),
(8, 'ADavies', '8c123443bde8c41040a3321a13e4628b', 'Andrew', 'Davies', 'andrew.davies@nbt.nhs.uk', 'North Bristol NHS Trust', 1, 0),
(9, 'AJacklin', 'b3cf46f81a38c766a4ebb0021b3a43ab', 'Ann', 'Jacklin', 'ann.jacklin@imperial.nhs.uk', 'Imperial College Healthcare NHS Trust', 1, 1),
(10, 'ASlee', '4122f363ff8d7f47951ef7a1f4b89dea', 'Ann', 'Slee', 'ann.slee@uhb.nhs.uk', 'University Hospital Birmingham NHS Foundation Trust', 1, 1),
(11, 'CFarrow', 'a7bf006e541ba1283a576609efcbe897', 'Carol', 'Farrow', 'carol.farrow@nnuh.nhs.uk', 'Norfolk and Norwich University Hospital NHS Trust', 1, 0),
(12, 'CBarrass', '0338f4893d7fd22ed3bc415d13652562', 'Chris', 'Barrass', 'chris.barrass@kch.nhs.uk', 'King''s College Hospital NHS Foundation Trust', 1, 0),
(13, 'CEvans', '765d57b7aaf401aa31adbd3e1018c320', 'Chris', 'Evans', 'Chris.Evans@stgeorges.nhs.uk', 'St George''s Healthcare NHS Trust', 1, 0),
(14, 'DChild', '6787b726e249ac1ef0bd57debe353701', 'Damian', 'Child', 'damian.child@sth.nhs.uk', 'Sheffield Teaching Hospitals NHS Trust', 1, 0),
(15, 'DRoberts', 'd41b0a8d0f7f09e2e1f6c903e4de374e', 'Dave', 'Roberts', 'Darrell.Baker@CardiffandVale.wales.nhs.uk', 'Cardiff & Vale University Health Board', 1, 1),
(16, 'DCorral', '4a9d3a966cc06297e6a99b5cd0e6bfb5', 'David', 'Corral', 'David.Corral@hey.nhs.uk', 'Hull and East Yorkshire Hospital NHS Trust', 1, 0),
(17, 'DWebb', 'c93656415d7f9af9ecc8457d2e03e92e', 'David', 'Webb', 'david.webb@londonscg.nhs.uk', 'London Specialised Commissioning Group', 1, 0),
(18, 'EMcCusker', '55f95ce09e1a6949fab1425b132a5fdf', 'Eimear', 'McCusker', 'eimear.mccusker@belfasttrust.hscni.net', 'The Royal Hospitals Belfast NHS Trust', 1, 0),
(19, 'HHowe', '9730000803ac23cbd849125312ff2cf2', 'Helen', 'Howe', 'helen.howe@addenbrookes.nhs.uk', 'Cambridge University Hospitals NHS Foundation Trust', 1, 0),
(20, 'JHarchowal', '4c198b6c1617944540a3518add0fb841', 'Jatinder', 'Harchowal', 'Jatinder.Harchowal@bsuh.nhs.uk', 'Brighton and Sussex University Hospitals NHS Trust ', 1, 0),
(21, 'JDorey', 'ff9f19a3d2c2165a23ede1c9e52013fc', 'Jenny', 'Dorey', 'Jenny.Dorey@orh.nhs.uk', 'Oxford Radcliffe Hospitals NHS Trust', 1, 1),
(22, 'SWilliams', '1ebfdfbf518773ad1acfc8a06fa531cc', 'Steve', 'Williams', 'steve.williams@uhsm.nhs.uk', 'University Hospital of South Manchester NHS Foundation Trust', 1, 1),
(23, 'JVincent', '4b20d5ae5f5c61cba26c40fcf58f7816', 'Judith', 'Vincent', 'Judith.Vincent@wales.nhs.uk', 'Abertawe Bro Morgannwg University Health Board (swansea)', 1, 1),
(24, 'JScanlan', '414e4106dda59beef9b18aeda3279bb8', 'Justine', 'Scanlan', 'justine.scanlan@srht.nhs.uk', 'Salford Royal NHS Foundation Trust', 1, 1),
(25, 'KRobertson', '56389a154ba29964b13aa8cb59baf256', 'Karen', 'Robertson', 'karen.robertson@chelwest.nhs.uk', 'Chelsea and Westminster Healthcare NHS Trust', 1, 0),
(26, 'LBurrow', 'c1e7dfa7b8eee1aa663518d4fea19aac', 'Lucy', 'Burrow', 'lucyburrow@nhs.net', 'NHS Tayside', 1, 1),
(27, 'MNorval', '289392b870e1b165423afba767a9d9b2', 'Mags', 'Norval', 'mags.norval@aintree.nhs.uk', 'University Hospital Aintree NHS Trust', 1, 0),
(28, 'MPartridge', 'a09d1bca557b5a1edf56af2b28a64adc', 'Malcolm', 'Partridge', 'malcolm.partridge@nuh.nhs.uk', 'Nottingham University Hospitals NHS Trust', 1, 0),
(29, 'MEaster', 'a5bdd228180bc88b168071153d5c9d99', 'Mark', 'Easter', 'mark.easter@uhcw.nhs.uk', 'University Hospitals', 1, 0),
(30, 'DPitkin', 'e1f0f0daf98e1c7b5c0b25a4c0889a32', 'David', 'Pitkin', 'david.pitkin@york.nhs.uk', 'York Hospitals NHS Foundation Trust ', 1, 0),
(31, 'MPhillips', 'f5cdf60dc00bb3fe27a6b614f57f6453', 'Martin', 'Phillips', 'Martin.Phillips1@newhamhealth.nhs.uk', 'Newham University Hospitals NHS Trust', 1, 1),
(32, 'MStephens', 'b059999361b9dcf97a183b0f4b4650e1', 'Martin', 'Stephens', 'Martin.Stephens@dh.gsi.gov.uk', 'Department of Health', 1, 1),
(33, 'MScott', '9ca98cf6cadd53b96e3c61ae48869202', 'Michael', 'Scott', 'DrMichael.Scott@northerntrust.hscni.net', 'Northern Health and Social Care Trust', 1, 1),
(34, 'NWatson', '8b8919bed9e9f67c72fb773a7dc83bfa', 'Neil', 'Watson', 'Neil.Watson2@nuth.nhs.uk', 'Newcastle upon Tyne Hospitals NHS Foundation Trust', 1, 1),
(35, 'NLannigan', 'f2f95d492b2f0e6b1036a8b6d3bad8dd', 'Norman', 'Lannigan', 'Norman.Lannigan@ggc.scot.nhs.uk', 'NHS Greater Glasgow and Clyde', 1, 0),
(36, 'RGoodman', '4c8202075b39aa73f2de7c066d598b1a', 'Richard', 'Goodman', 'R.Goodman@rbht.nhs.uk', 'Royal Brompton and Harefield NHS Trust', 1, 0),
(37, 'RHey', '5be469b7f761eef1f8eacd196e70f17d', 'Richard', 'Hey', 'Richard.Hey@cmft.nhs.uk', 'Central Manchester University Hospitals NHS Foundation Trust', 1, 0),
(38, 'RUrquhart', '61048de81e1c2e77c9754f4343652e34', 'Robert', 'Urquhart', 'Robert.Urquhart@uclh.nhs.uk', 'University College London Hospitals NHS Foundation Trust', 1, 0),
(39, 'SBrown', '658518812f4f41b1bfe728b4acd2d762', 'Stephen', 'Brown', 'Stephen.Brown@ubht.nhs.uk', 'United Bristol Healthcare NHS Trust', 1, 0),
(40, 'SSemple', 'fd8e43de0b3338b211d0a5799af57f8c', 'Stuart', 'Semple', 'Stuart.Semple@bartsandthelondon.nhs.uk', 'Barts and The London NHS Trust', 1, 1),
(41, 'SBassan', 'e4b77eaf5eabeb17eff01ac150d309ee', 'Surinder', 'Bassan', 'Surinder.Bassan@suht.swest.nhs.uk', 'Southampton University Hospital NHS Trust', 1, 1),
(42, 'SThomson', 'feb576af70530fd764046849f0e1c918', 'Susan', 'Thomson', 'Susan.Thomson@uhns.nhs.uk', 'University Hospital of North Staffordshire NHS Trust', 1, 0),
(43, 'SKhalid ', 'cc28410c885250ac45d8f9f43f86c739', 'Suzanne', 'Khalid ', 'Suzanne.Khalid@uhl-tr.nhs.uk', 'University Hospitals of Leicester NHS Trust', 1, 1),
(44, 'TCarruthers ', '0d1d5be72e8522c682640a50b1c0794e', 'Tania', 'Carruthers ', 'tania.carruthers@heartofengland.nhs.uk', 'Heart of England NHS Foundation Trust', 1, 1),
(45, 'TGray', '3759cb42527a73db7d9f315e03f094bd', 'Tom', 'Gray', 'tom.Gray@nhs.net', 'Derby Hospitals NHS Foundation Trust', 1, 1),
(46, 'DWalker', 'e3eebb7b095bb0150e5da31b8688d2be', 'Debra', 'Walker', 'debra.walker@alderhey.nhs.uk', 'Royal Liverpool Children''s NHS Trust', 1, 0),
(47, 'TWest', 'beaa43dfe9713a240dbe34aa0f517d59', 'Tony', 'West', 'Tony.West@gstt.nhs.uk', 'Guy''s and St Thomas'' NHS Foundation Trust', 1, 0),
(48, 'WSpicer', '2cd5befc9902ccda3c872e18f4fe4eee', 'Wendy', 'Spicer', 'Wendy.Spicer@royalfree.nhs.uk ', 'The Royal Free Hampstead NHS Trust ', 1, 0),
(49, 'MStephens', '27e04d530acd953aaf141a3e6c0d2ad7', 'Martin', 'Stephens', 'martin.stephens@uhs.nhs.uk', 'Department of Health', 1, 0),
(50, 'RFallon', '2d22fa8ace81b7c8cbebc0fa198a41e7', 'Rachael', 'Fallon', 'Rachael.Fallon@nhs.net', 'Wirral Hospitals NHS Trust', 3, 1),
(51, 'JHough', 'aaa70de49b67aaeb30a1641ef99849b2', 'Jane', 'Hough', 'jane.hough@orh.nhs.uk', 'Oxford Radcliffe Hospitals NHS Trust', 1, 1),
(52, 'BVadher', '0e03a163952ff0b380a41cbc7ee1cf0e', 'Bhulesh', 'Vadher', 'Bhulesh.Vadher@orh.nhs.uk', 'Oxford Radcliffe Hospitals NHS Trust', 1, 0),
(53, 'TCarruthers', '8626da07747174e7be86149a2cb3fe38', 'Tania', 'Carruthers', 'tania.carruthers@heartofengland.nhs.uk', 'Heart of England NHS Foundation Trust', 1, 0),
(54, 'CSkitterall', '36a3feb1a7d97cad5701fa858fda402f', 'Charlotte', 'Skitterall', 'Charlotte.Skitterall@uhsm.nhs.uk ', 'University Hospital of South Manchester NHS Foundation Trust', 1, 0),
(55, 'DCampbell', 'a0822928172143fe6efec9b1e79e2e4b', 'David', 'Campbell', 'david.campbell@nhct.nhs.uk', 'Northumbria Healthcare NHS Foundation Trust', 1, 0),
(56, 'JVincent', '968d191784bcb1719a4c55596c16fbb2', 'Judith', 'Vincent', 'Judith.Vincent@wales.nhs.uk', 'University Health Board', 1, 0),
(57, 'JScanlan', '2fd30423b2d8e8f86e8fb974e4e02537', 'Justine', 'Scanlan', 'justine.scanlan@srft.nhs.uk', 'Salford Royal NHS Foundation Trust', 1, 0),
(58, 'MScott', '6fb1787e137363b925b2c2770540c62e', 'Michael', 'Scott', 'DrMichael.Scott@northerntrust.hscni.net', 'Antrim Hospital', 1, 0),
(59, 'NWatson', 'c2dc22eb18f9602d602587b7f3962ba6', 'Neil', 'Watson', 'Neil.Watson2@nuth.nhs.uk', 'Freeman Hospital', 1, 0),
(60, 'PMurray', 'fa943e4e993b6a78837a3022ed8c651a', 'Pat', 'Murray', 'pat.murray@nhslothian.scot.nhs.uk', 'Royal Infirmary of Edinburth', 1, 1),
(61, 'SSemple', '2a7e91c5a088cd6fc163b1ee6d1f1878', 'Stuart', 'Semple', 'Stuart.Semple@bartsandthelondon.nhs.uk', 'The Royal London Hospital', 1, 0),
(62, 'SBassan', '3b1dab9fd57ec5082fddb50bef7e5782', 'Surrinder', 'Bassan', 'Surinder.Bassan@suht.swest.nhs.uk', 'Southampton General Hospital', 1, 1),
(63, 'JTolan', 'bd3de74225ec3fd4fc4e1792fd72caac', 'Julia', 'Tolan', 'julia.tolan@belfasttrust.hscni.net', 'The Royal Hospitals Belfast NHS Trust', 1, 0),
(64, 'CNewman', 'e7bb1fd5b68aeb06d5a94a4112fb14a7', 'Clive', 'Newman', 'Clive.Newman1@nhs.net ', 'Derby Hospitals NHS Foundation Trust', 1, 0),
(65, 'CJones', '711585f0e55e5494cdd72f1e9ff1404f', 'Catherine', 'Jones', 'catherinejones9@nhs.net', 'Arrow Park', 3, 0),
(66, 'EMorrison', 'c4f1abd8cca95add8a1a18a18d84896c', 'Ewan', 'Morrison', 'Ewan.Morrison@nhslothian.scot.nhs.uk', 'NHS Lothian Pharmacy Service', 1, 0),
(67, 'DSmith', '9681bcf986c247167f9adbd6c1db1ead', 'David', 'Smith', 'david.smith@bthft.nhs.uk', 'Bradford Teaching Hospitals NHS Foundation Trust', 1, 0),
(68, 'RFitzpatrick', 'ededa48a03ec9a59bee717e5e3facdc2', 'Ray', 'Fitzpatrick', 'rayfitzpatrick@nhs.net', 'The Royal Wolverhampton NHS Trust', 1, 0),
(69, 'JMiller', '4818a3b5deba9ddd02ad7f5b9e0b038b', 'Jacqueline', 'Miller', 'JacquelineDiane.Miller@stees.nhs.uk', 'South Tees Hospitals NHS Foundation Trust', 1, 0),
(70, 'SLadds', '007b65e3e07a8f68539f30cebacf230a', 'Sue', 'Ladds', 'sue.ladds@uhs.nhs.uk', 'Southampton University Hospital NHS Trust', 1, 0),
(71, 'BPattani', '4fa585ef25997c9b18e20971b0250b04', 'Bhavisha', 'Pattani', 'bhavisha.pattani@uhl-tr.nhs.uk', 'University Hospitals of Leicester NHS Trust', 3, 0),
(72, 'CEllwood', '1b9c49524f2b9501b216de48dee880e6', 'Claire', 'Ellwood', 'claire.ellwood@uhl-tr.nhs.uk', 'University Hospitals of Leicester NHS Trust', 3, 0),
(73, 'AMounsey', '2aee7346cb4a9c644b397ce296f42e56', 'Ann', 'Mounsey', 'ann.mounsey@imperial.nhs.uk', 'Imperial College Healthcare NHS Trust', 3, 0),
(74, 'DBaker', 'e113abe9317562c89430c5344f45cc5c', 'Darrell', 'Baker', 'darrell.baker@cardiffandvale.wales.nhs.uk', 'Cardiff and Vale University Health Board', 3, 0),
(75, 'ISingh', '146aa1391a61c0e3ad9e3739ce4f09b4', 'Inderjit', 'Singh', 'inderjit.singh@bch.nhs.uk', 'University Hospitals Birmingham NHS Foundation Trust', 3, 0),
(76, 'DLinnard', '97cb5fd45aeb0bc894841615fba31efa', 'Deirdre ', 'Linnard', 'deirdre.linnard@chelwest.nhs.uk', 'Chelsea and Westminster Healthcare NHS Trust', 1, 0),
(77, 'JProctor', 'a200cd2562afb2953c9b7e4a24fd6ebe', 'James', 'Proctor', 'james.proctor@wjps.co.uk', 'None', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `userscategorys`
--

CREATE TABLE `userscategorys` (
  `IDLNK` int(11) NOT NULL AUTO_INCREMENT,
  `UserIDLNK` int(11) NOT NULL,
  `CategoryIDLNK` int(11) NOT NULL,
  `Deleted` varchar(1) NOT NULL,
  PRIMARY KEY (`IDLNK`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=67 ;

--
-- Dumping data for table `userscategorys`
--

INSERT INTO `userscategorys` (`IDLNK`, `UserIDLNK`, `CategoryIDLNK`, `Deleted`) VALUES
(2, 4, 2, '0'),
(3, 4, 1, '0'),
(6, 15, 1, '0'),
(7, 1, 2, '0'),
(8, 1, 1, '0'),
(9, 3, 2, '0'),
(10, 3, 1, '0'),
(11, 39, 1, '0'),
(12, 12, 1, '0'),
(13, 14, 1, '0'),
(14, 16, 1, '0'),
(15, 8, 1, '0'),
(17, 13, 1, '0'),
(18, 7, 1, '0'),
(19, 50, 1, '0'),
(20, 11, 1, '0'),
(21, 36, 1, '0'),
(23, 20, 1, '0'),
(24, 37, 1, '0'),
(25, 51, 1, '0'),
(26, 19, 1, '0'),
(27, 9, 1, '0'),
(28, 43, 1, '0'),
(29, 35, 1, '0'),
(30, 18, 1, '0'),
(31, 27, 1, '0'),
(32, 5, 1, '0'),
(33, 28, 1, '0'),
(34, 30, 1, '0'),
(35, 25, 1, '0'),
(36, 10, 1, '0'),
(39, 48, 1, '0'),
(41, 42, 1, '0'),
(42, 38, 1, '0'),
(43, 52, 1, '0'),
(44, 46, 1, '0'),
(45, 17, 1, '0'),
(46, 47, 1, '0'),
(47, 22, 1, '0'),
(49, 6, 2, '0'),
(50, 6, 1, '0'),
(52, 45, 1, '0'),
(53, 29, 1, '0'),
(55, 55, 1, '0'),
(56, 49, 1, '0'),
(57, 76, 1, '0'),
(63, 74, 6, '0'),
(64, 59, 6, '0'),
(65, 17, 6, '0'),
(66, 74, 8, '0');
