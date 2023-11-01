SELECT
  EXTRACT(year FROM e.datum) AS year,
  CAST(SUM((e.ar * IF(a.arfolyam is NULL, d.alap_arfolyam, a.arfolyam) * (e.mennyiseg))) AS DECIMAL(10,2)) AS forgalom_HU,
  CAST(SUM((e.ar * IF(a.arfolyam is NULL, d.alap_arfolyam, a.arfolyam) * (e.mennyiseg))) / IF(ae.arfolyam IS NULL, de.alap_arfolyam, ae.arfolyam) AS DECIMAL(10,2)) AS forgalom_EUR
FROM eladas AS e
LEFT JOIN deviza AS d ON d.id = e.deviza_id
LEFT JOIN deviza AS de ON de.id = 2
LEFT JOIN arfolyam AS a ON a.deviza_id = e.deviza_id AND EXTRACT(YEAR FROM e.datum) = a.ev AND EXTRACT(MONTH FROM e.datum) = a.ho
LEFT JOIN arfolyam AS ae ON ae.deviza_id = 2 AND EXTRACT(YEAR FROM e.datum) = ae.ev AND EXTRACT(MONTH FROM e.datum) = ae.ho
GROUP BY EXTRACT(year FROM e.datum);